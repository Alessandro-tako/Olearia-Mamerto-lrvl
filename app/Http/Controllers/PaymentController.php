<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;

class PaymentController extends Controller
{
    public function summary()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('article')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('message', 'Il carrello è vuoto!');
        }

        $total = $cartItems->sum(fn($item) => $item->article->price * $item->quantity);
        return view('checkout-summary', compact('cartItems', 'total'));
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('article')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('message', 'Il carrello è vuoto!');
        }

        $total = $cartItems->sum(fn($item) => $item->article->price * $item->quantity);

        $tokenResponse = Http::asForm()->withBasicAuth(
            config('paypal.sandbox.client_id'),
            config('paypal.sandbox.client_secret')
        )->post('https://api-m.sandbox.paypal.com/v1/oauth2/token', [
            'grant_type' => 'client_credentials',
        ]);

        if (!$tokenResponse->successful()) {
            Log::error('❌ Errore PayPal (token): ' . $tokenResponse->body());
            return redirect()->route('cart.show')->with('message', 'Errore nell\'ottenere il token di accesso.');
        }

        $accessToken = $tokenResponse->json()['access_token'];

        // Recupera indirizzo di spedizione dell'utente
        $shipping = ShippingAddress::where('user_id', Auth::id())->latest()->first();

        $orderResponse = Http::withToken($accessToken)->post('https://api-m.sandbox.paypal.com/v2/checkout/orders', [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => number_format($total, 2, '.', ''),
                ],
                'shipping' => [
                    'name' => [
                        'full_name' => Auth::user()->name,
                    ],
                    'address' => [
                        'address_line_1' => $shipping->address ?? 'Indirizzo mancante',
                        'admin_area_2' => $shipping->city ?? '',
                        'postal_code' => $shipping->postal_code ?? '',
                        'country_code' => 'IT',
                    ],
                ],
            ]],
            'application_context' => [
                'return_url' => route('payment.success'),
                'cancel_url' => route('payment.cancel'),
            ],
        ]);

        $orderData = $orderResponse->json();
        Log::info('🧾 PayPal order response: ' . json_encode($orderData));

        $approveLink = collect($orderData['links'])->firstWhere('rel', 'approve')['href'] ?? null;

        if (!$approveLink) {
            Log::error('❌ Link di approvazione non trovato: ' . json_encode($orderData));
            return redirect()->route('shipping.update')->with('message', 'Impossibile procedere al pagamento inserisci il tuo indirizzo.');
        }

        return redirect()->away($approveLink);
    }

    public function success(Request $request)
{
    $token = $request->get('token');

    $tokenResponse = Http::asForm()->withBasicAuth(
        config('paypal.sandbox.client_id'),
        config('paypal.sandbox.client_secret')
    )->post('https://api-m.sandbox.paypal.com/v1/oauth2/token', [
        'grant_type' => 'client_credentials',
    ]);

    if (!$tokenResponse->successful()) {
        Log::error('❌ Errore PayPal (token success): ' . $tokenResponse->body());
        return redirect()->route('cart.show')->with('message', 'Errore durante la conferma del pagamento.');
    }

    $accessToken = $tokenResponse->json()['access_token'];

    // Recupera i dettagli dell'ordine PayPal
    $orderResponse = Http::withToken($accessToken)->get("https://api-m.sandbox.paypal.com/v2/checkout/orders/{$token}");
    $orderData = $orderResponse->json();
    $payerId = $orderData['payer']['payer_id'] ?? null;

    if (!$payerId) {
        Log::error('❌ Payer ID non trovato nella risposta dell\'ordine PayPal: ' . json_encode($orderData));
        return redirect()->route('cart.show')->with('message', 'Impossibile completare il pagamento.');
    }

    $capture = Http::withToken($accessToken)
        ->post("https://api-m.sandbox.paypal.com/v2/checkout/orders/{$token}/capture", [
            'payer_id' => $payerId,
        ]);

    $data = $capture->json();
    Log::info('✅ Risposta Capture PayPal: ' . json_encode($data));

    $isCompleted = false;

    if (isset($data['status']) && $data['status'] === 'COMPLETED') {
        $isCompleted = true;
    }

    if (!$isCompleted && isset($data['purchase_units'][0]['payments']['captures'][0]['status'])) {
        $isCompleted = $data['purchase_units'][0]['payments']['captures'][0]['status'] === 'COMPLETED';
    }

    if ($isCompleted) {
        $user = Auth::user();
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $this->calculateTotalAmount($user->id),
            // 'status' viene lasciato al valore di default: 'Pagato e in attesa'
        ]);

        $cartItems = Cart::where('user_id', $user->id)->with('article')->get();

        foreach ($cartItems as $item) {
            // Verifica se lo stock è sufficiente prima di procedere
            if ($item->article->stock < $item->quantity) {
                Log::error("❌ Stock insufficiente per l'articolo ID: {$item->article_id}");
                return redirect()->route('cart.show')->with('message', 'Stock insufficiente per uno o più articoli.');
            }

            // Aggiorna lo stock dell'articolo
            $item->article->stock -= $item->quantity;
            $item->article->save();

            // Crea l'ordine dell'articolo
            OrderItem::create([
                'order_id' => $order->id,
                'article_id' => $item->article_id,
                'quantity' => $item->quantity,
                'price' => $item->article->price,
            ]);
        }

        // Rimuovi gli articoli dal carrello dell'utente
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('orders.index')->with('message', 'Pagamento completato con successo!');
    }

    Log::error('❌ Pagamento non completato: ' . json_encode($data));
    return redirect()->route('cart.show')->with('message', 'Errore durante il pagamento.');
}


    private function calculateTotalAmount($userId)
    {
        $cartItems = Cart::where('user_id', $userId)->with('article')->get();
        return $cartItems->sum(fn($item) => $item->article->price * $item->quantity);
    }

    public function cancel()
    {
        return redirect()->route('cart.show')->with('message', 'Pagamento annullato.');
    }
}

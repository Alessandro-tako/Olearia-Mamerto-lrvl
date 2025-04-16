<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class PaymentController extends Controller
{
    // ✅ Pagina riepilogo
    public function summary()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('article')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('message', 'Il carrello è vuoto!');
        }

        $total = $cartItems->sum(fn($item) => $item->article->price * $item->quantity);

        return view('checkout-summary', compact('cartItems', 'total'));
    }

    // ✅ Checkout → PayPal
    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('article')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('message', 'Il carrello è vuoto!');
        }

        $total = $cartItems->sum(fn($item) => $item->article->price * $item->quantity);

        $response = Http::asForm()->withBasicAuth(
            config('paypal.sandbox.client_id'),
            config('paypal.sandbox.client_secret')
        )->post('https://api-m.sandbox.paypal.com/v1/oauth2/token', [
            'grant_type' => 'client_credentials',
        ]);

        if (!$response->successful()) {
            \Log::error('Errore PayPal (token): ' . $response->body());
            return redirect()->route('cart.show')->with('message', 'Errore nell\'ottenere il token di accesso.');
        }

        $accessToken = $response->json()['access_token'];

        $order = Http::withToken($accessToken)->post('https://api-m.sandbox.paypal.com/v2/checkout/orders', [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => number_format($total, 2, '.', ''),
                ],
            ]],
            'application_context' => [
                'return_url' => route('payment.success'),
                'cancel_url' => route('payment.cancel'),
            ],
        ]);

        $orderData = $order->json();
        $approveLink = collect($orderData['links'])->firstWhere('rel', 'approve')['href'] ?? null;

        if (!$approveLink) {
            \Log::error('Link di approvazione non trovato: ' . json_encode($orderData));
            return redirect()->route('cart.show')->with('message', 'Impossibile procedere al pagamento.');
        }

        return redirect()->away($approveLink);
    }

    // ✅ Successo pagamento
    public function success(Request $request)
{
    $token = $request->get('token');

    $response = Http::asForm()->withBasicAuth(
        config('paypal.sandbox.client_id'),
        config('paypal.sandbox.client_secret')
    )->post('https://api-m.sandbox.paypal.com/v1/oauth2/token', [
        'grant_type' => 'client_credentials',
    ]);

    if (!$response->successful()) {
        \Log::error('Errore PayPal (token success): ' . $response->body());
        return redirect()->route('cart.show')->with('message', 'Errore durante la conferma del pagamento.');
    }

    $accessToken = $response->json()['access_token'];

    $capture = Http::withToken($accessToken)
        ->post("https://api-m.sandbox.paypal.com/v2/checkout/orders/{$token}/capture");

    $data = $capture->json();

    // Debug temporaneo
    \Log::info('Risposta Capture PayPal: ' . json_encode($data));

    $isCompleted = false;

    if (isset($data['status']) && $data['status'] === 'COMPLETED') {
        $isCompleted = true;
    }

    // A volte PayPal mette lo status nel nested array → fallback
    if (!$isCompleted && isset($data['purchase_units'][0]['payments']['captures'][0]['status'])) {
        $isCompleted = $data['purchase_units'][0]['payments']['captures'][0]['status'] === 'COMPLETED';
    }

    if ($isCompleted) {
        $user = Auth::user();
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $this->calculateTotalAmount($user->id),
            'status' => 'paid',
            'payment_method' => 'paypal',
        ]);

        $cartItems = Cart::where('user_id', $user->id)->with('article')->get();
        dd($cartItem);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'article_id' => $cartItem->article_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->article->price,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('orders.index')->with('message', 'Pagamento completato con successo!');
    }

    \Log::error('Pagamento non completato: ' . json_encode($data));
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

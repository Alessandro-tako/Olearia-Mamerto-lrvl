<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class PaymentController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('article')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('message', 'Il carrello è vuoto!');
        }

        $total = $cartItems->sum(fn($item) => $item->article->price * $item->quantity);

        // Ottieni access token
        $response = Http::asForm()->withBasicAuth(
            config('paypal.sandbox.client_id'),
            config('paypal.sandbox.client_secret')
        )
            ->post('https://api-m.sandbox.paypal.com/v1/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);

        if (!$response->successful()) {
            // Log del corpo della risposta per il debug
            \Log::error('Errore PayPal: ' . $response->body());
            return redirect()->route('cart.show')->with('message', 'Errore nell\'ottenere il token di accesso.');
        }

        $accessToken = $response->json()['access_token'] ?? null;

        if (!$accessToken) {
            // Log se il token non è presente
            \Log::error('Token di accesso non trovato nella risposta: ' . $response->body());
            return redirect()->route('cart.show')->with('message', 'Token di accesso non valido.');
        }


        // Crea ordine
        $order = Http::withToken($accessToken)->post('https://api-m.sandbox.paypal.com/v2/checkout/orders', [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => number_format($total, 2, '.', ''),
                ],
            ]],
            'application_context' => [
                'return_url' => route('paypal.success'),
                'cancel_url' => route('paypal.cancel'),
            ],
        ]);

        $orderData = $order->json();

        // Trova link approvazione
        $approveLink = collect($orderData['links'])->firstWhere('rel', 'approve')['href'];

        return redirect()->away($approveLink);
    }

    public function success(Request $request)
    {
        $token = $request->get('token');

        // Ottieni nuovo access token
        $response = Http::asForm()->withBasicAuth(config('paypal.client_id'), config('paypal.secret'))
            ->post('https://api-m.sandbox.paypal.com/v1/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);

        $accessToken = $response->json()['access_token'];

        // Cattura pagamento
        $capture = Http::withToken($accessToken)
            ->post("https://api-m.sandbox.paypal.com/v2/checkout/orders/{$token}/capture");

        $data = $capture->json();

        if (($data['status'] ?? null) === 'COMPLETED') {
            // Svuota il carrello o salva ordine
            Cart::where('user_id', Auth::id())->delete();

            return redirect()->route('cart.show')->with('message', 'Pagamento completato con successo!');
        }

        return redirect()->route('cart.show')->with('message', 'Errore durante il pagamento.');
    }

    public function cancel()
    {
        return redirect()->route('cart.show')->with('message', 'Pagamento annullato.');
    }
}

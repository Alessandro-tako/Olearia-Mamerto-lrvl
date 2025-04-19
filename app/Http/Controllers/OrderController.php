<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShippingAddress;
use App\Mail\OrderPaidMail;
use App\Mail\OrderConfirmedMail;
use App\Mail\OrderShippedMail;
use App\Mail\OrderCancelledMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    // Mostra gli ordini dell'utente
    public function userOrders()
    {
        $user = Auth::user();  // Recupera l'utente autenticato
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Devi essere loggato per visualizzare gli ordini.');
        }

        $shippingAddress = ShippingAddress::where('user_id', $user->id)->latest()->first();
        $orders = Order::where('user_id', $user->id)->get();  // Recupera gli ordini dell'utente
        
        return view('user.profile', compact('user', 'shippingAddress', 'orders'));  // Passa anche gli ordini
    }

    // Mostra tutti gli ordini per l'amministratore
    public function adminOrders(Request $request)
    {
        // $this->authorize('viewAny', Order::class); // Assicurati che solo l'amministratore possa vedere gli ordini

        if ($request->filled('search')) {
            $orders = Order::search($request->input('search'))->get();
        } else {
            $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        }

        return view('admin.admin_orders', compact('orders'));
    }

    // Modifica lo stato di un ordine (solo per admin)
    public function updateStatus(Request $request, Order $order)
    {
        // Controlla se l'utente è un amministratore
        if (!Auth::user()->is_admin) {
            return redirect()->route('home')->with('error', 'Non hai permessi per modificare lo stato dell\'ordine.');
        }

        // Validazione dello stato
        $validated = $request->validate([
            'status' => 'required|in:Pagato e in attesa,Confermato,Spedito,cancellato',
        ]);

        // Aggiorna lo stato dell'ordine
        $order->status = $request->input('status');
        $order->save();

        // Invia l'email in base allo stato
        switch ($order->status) {
            case 'Pagato e in attesa':
                // Invia email di acquisto
                Mail::to($order->user->email)->send(new OrderPaidMail($order));
                break;

            case 'Confermato':
                // Invia email di conferma
                Mail::to($order->user->email)->send(new OrderConfirmedMail($order));
                break;

            case 'Spedito':
                // Invia email di spedizione
                Mail::to($order->user->email)->send(new OrderShippedMail($order));
                break;

            case 'cancellato':
                // Invia email di annullamento
                Mail::to($order->user->email)->send(new OrderCancelledMail($order));
                break;
        }

        return redirect()->back()->with('success', 'Stato aggiornato con successo!');
    }
}

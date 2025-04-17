<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Mostra gli ordini dell'utente
    public function userOrders()
    {
        $user = Auth::user();  // Recupera l'utente autenticato
        $shippingAddress = ShippingAddress::where('user_id', $user->id)->latest()->first();
        $orders = Order::where('user_id', $user->id)->get();  // Recupera gli ordini dell'utente
        
        return view('user.profile', compact('user', 'shippingAddress', 'orders'));  // Passa anche gli ordini
    }
    

    // Mostra tutti gli ordini per l'amministratore
    public function adminOrders()
    {
        $orders = Order::with('user')->get(); // Carica gli ordini con l'utente
        return view('admin.admin_orders', compact('orders'));
    }

    // Modifica lo stato di un ordine (solo per admin)
    public function updateStatus(Request $request, Order $order)
    {
        // Validazione dello stato
        $validated = $request->validate([
            'status' => 'required|in:Pagato e in attesa,Confermato,Spedito,cancellato',
        ]);
    
        // Aggiorna lo stato dell'ordine
        $order->status = $request->input('status');
        $order->save();
    
        return redirect()->back()->with('success', 'Stato aggiornato con successo!');
    }
    
}

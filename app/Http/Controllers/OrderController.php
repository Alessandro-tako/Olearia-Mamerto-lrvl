<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Mostra gli ordini dell'utente
    public function userOrders()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('user.profile', compact('orders'));
    }

    // Mostra tutti gli ordini per l'amministratore
    public function adminOrders()
    {
        $orders = Order::with('user')->get(); // Carica gli ordini con l'utente
        return view('admin.admin_orders', compact('orders'));
    }

    // Modifica lo stato di un ordine (solo per admin)
    public function updateStatus(Order $order, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders')->with('message', 'Stato ordine aggiornato con successo!');
    }
}

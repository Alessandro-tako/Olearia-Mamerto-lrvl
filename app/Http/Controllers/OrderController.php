<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Mail\OrderPaidMail;
use Illuminate\Http\Request;
use App\Mail\OrderShippedMail;
use App\Models\ShippingAddress;
use App\Mail\OrderCancelledMail;
use App\Mail\OrderConfirmedMail;
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
        // Assicurati che solo l'amministratore possa vedere gli ordini
        // $this->authorize('viewAny', Order::class);

        if ($request->filled('search')) {
            $orders = Order::search($request->input('search'))->get();
        } else {
            $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        }

        return view('admin.admin_orders', compact('orders'));
    }

    // Calcola il totale dell'ordine tenendo conto degli sconti in valore assoluto
    protected function calculateOrderTotal(Order $order)
    {
        $total = 0;
        foreach ($order->items as $item) {
            $unitPrice = $item->article->price ?? 0; // Prezzo pieno
            $discount = $item->article->discount ?? 0; // Sconto in valore assoluto
            $finalPrice = $unitPrice - $discount; // Calcolo del prezzo finale con sconto assoluto
            $total += $finalPrice * $item->quantity; // Aggiungi al totale
        }
        $order->total_amount = $total;
        $order->save();
        return $total;
    }

    public function deleteUser(User $user)
    {
        // Elimina l'utente
        $user->delete();

        // Aggiorna lo stato degli ordini associati a questo utente
        Order::where('user_id', $user->id)
            ->update(['status' => 'Utente eliminato']);
    }

    public function updateStatus(Request $request, Order $order)
    {
        // Verifica che l'utente sia un amministratore
        if (!Auth::user()->is_admin) {
            return redirect()->route('home')->with('error', 'Non hai permessi per modificare lo stato dell\'ordine.');
        }
    
        // Se l'ordine è associato a un utente eliminato, non permettere modifiche
        if ($order->user === null) {
            return redirect()->back()->with('error', 'Non puoi modificare lo stato dell\'ordine perché l\'utente è stato eliminato.');
        }
    
        // Validazione dello stato
        $validated = $request->validate([
            'status' => 'required|in:Pagato e in attesa,Confermato,Spedito,Cancellato,Utente eliminato',
        ]);
    
        // Calcolare il totale dell'ordine con lo sconto in valore assoluto
        $total = $this->calculateOrderTotal($order);
    
        // Controlla se lo stato è diverso dal precedente prima di aggiornarlo
        if ($order->status === $request->input('status')) {
            return redirect()->back()->with('info', 'Lo stato dell\'ordine è già impostato su "' . $order->status . '".');
        }
    
        // Se lo stato è "Utente eliminato", aggiorna lo stato
        if ($request->input('status') === 'Utente eliminato') {
            $order->status = 'Utente eliminato';
            $order->save();  // Salva l'ordine dopo l'aggiornamento dello stato
    
            return redirect()->back()->with('success', 'Stato aggiornato a "Utente eliminato".');
        }
    
        // Se lo stato è valido, aggiorna lo stato
        $order->status = $request->input('status');
        $order->save();  // Salva l'ordine con il nuovo stato
    
        // Invia le email solo dopo aver aggiornato lo stato
        switch ($order->status) {
            case 'Pagato e in attesa':
                Mail::to($order->user->email)->send(new OrderPaidMail($order, $total));
                break;
    
            case 'Confermato':
                Mail::to($order->user->email)->send(new OrderConfirmedMail($order, $total));
                break;
    
            case 'Spedito':
                Mail::to($order->user->email)->send(new OrderShippedMail($order, $total));
                break;
    
            case 'Cancellato':
                Mail::to($order->user->email)->send(new OrderCancelledMail($order, $total));
                break;
        }
    
        return redirect()->back()->with('success', 'Stato aggiornato con successo!');
    }
    
    
}

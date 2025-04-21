<?php

namespace App\Http\Controllers;

use App\Mail\AccountDeleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    

    public function destroy(Request $request)
    {
        $user = $request->user();
    
        // Invia l'email di conferma
        Mail::to($user->email)->send(new AccountDeleted($user));
    
        // Anonimizza gli ordini
        foreach ($user->orders as $order) {
            $order->user_id = null;
            $order->save();
        }
    
        // Elimina indirizzo di spedizione associato (opzionale)
        if ($user->shippingAddress) {
            $user->shippingAddress->delete();
        }
    
        // Logout
        Auth::logout();
    
        // Hard delete dell'utente
        $user->forceDelete(); // IMPORTANTE: forza l'eliminazione anche se hai SoftDeletes attivo
    
        return redirect('/')->with('success', 'Il tuo account è stato eliminato.');
    }
    
}

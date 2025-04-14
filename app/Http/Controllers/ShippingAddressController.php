<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingAddressController extends Controller
{
    public function edit()
    {
        // Carica l'indirizzo di spedizione dell'utente
        $address = Auth::user()->shippingAddress ?? new ShippingAddress();
    
        return view('user.shipping', compact('address'));
    }

    public function update(Request $request)
    {
        // Validazione dei dati
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        // Ottieni l'indirizzo di spedizione dell'utente
        $address = Auth::user()->shippingAddress()->updateOrCreate(
            [], // La condizione di ricerca è vuota, quindi crea un nuovo indirizzo o aggiorna quello esistente
            $validated
        );

        return redirect()->route('user.profile')->with('success', 'Indirizzo aggiornato correttamente.');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Visualizza il carrello
    public function show()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('article')->get(); // Assicurati di caricare anche gli articoli
        return view('cart.index', compact('cartItems'));
    }

    // Aggiungi un articolo al carrello
    public function add(Article $article, Request $request)
    {
        // Verifica se c'è uno sconto e calcola il prezzo scontato
        $price = $article->price - $article->discount;  // Sottrai lo sconto dal prezzo originale
        
        // Ottieni la quantità dall'input
        $quantity = $request->quantity;
    
        // Verifica che la quantità non superi lo stock disponibile
        if ($quantity > $article->stock) {
            return redirect()->back()->with('error', 'La quantità selezionata è superiore allo stock disponibile.');
        }
    
        // Verifica se l'articolo è già presente nel carrello
        $cartItem = Cart::where('user_id', Auth::id())->where('article_id', $article->id)->first();
    
        if ($cartItem) {
            // Se l'articolo esiste già nel carrello, aggiorna la quantità
            $cartItem->increment('quantity', $quantity);
        } else {
            // Altrimenti, crea un nuovo articolo nel carrello
            Cart::create([
                'user_id' => Auth::id(),
                'article_id' => $article->id,
                'quantity' => $quantity,
                'price' => $price, // Memorizza il prezzo scontato
            ]);
        }
    
        return redirect()->back()->with('message', "Hai aggiunto $quantity articoli al tuo carrello.");
    }
    
    

    // Rimuovi un articolo dal carrello
    public function remove($cartId)
    {
        // Trova l'articolo nel carrello dell'utente e rimuovilo
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $cartId)->first();

        if ($cartItem) {
            $cartItem->delete(); // Rimuovi l'articolo dal carrello
        }

        return redirect()->back()->with('message', "hai rimosso l'articolo dal tuo carrello");
    }

    // Modifica la quantità di un articolo nel carrello
    public function updateQuantity(Request $request, $cartId)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $cartId)->first();
    
        if ($cartItem) {
            $quantity = $request->quantity;
    
            // Controlla se la quantità è valida (maggiore di 0)
            if ($quantity > 0) {
                $cartItem->update([
                    'quantity' => $quantity
                ]);
            } else {
                return redirect()->back()->with('error', 'La quantità deve essere maggiore di 0');
            }
        }
    
        return redirect()->back();
    }
    
}

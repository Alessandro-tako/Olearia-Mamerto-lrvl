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
    $price = $article->price - $article->discount; // Calcola il prezzo scontato
    $quantity = $request->quantity;

    // Verifica se l'articolo è già presente nel carrello
    $cartItem = Cart::where('user_id', Auth::id())
        ->where('article_id', $article->id)
        ->first();

    if ($cartItem) {
        $newQuantity = $cartItem->quantity + $quantity;

        // Controlla che la nuova quantità totale non superi lo stock
        if ($newQuantity > $article->stock) {
            return redirect()->back()->with('error', 'La quantità totale nel carrello supera lo stock disponibile.');
        }

        $cartItem->increment('quantity', $quantity);
    } else {
        // Se non è nel carrello, controlla semplicemente la quantità richiesta
        if ($quantity > $article->stock) {
            return redirect()->back()->with('error', 'La quantità selezionata è superiore allo stock disponibile.');
        }

        Cart::create([
            'user_id' => Auth::id(),
            'article_id' => $article->id,
            'quantity' => $quantity,
            'price' => $price,
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

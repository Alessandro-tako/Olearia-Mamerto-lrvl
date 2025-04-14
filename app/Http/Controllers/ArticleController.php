<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ArticleController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            // new Middleware('auth'), // Assicurati che l'utente sia autenticato
            new Middleware('isAdmin', only: ['create']) // Solo gli admin possono creare articoli
        ];
    }
    // dettaglio tutti gli articoli
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(6);
        return view('article.index', compact('articles'));
    }
    //pagina creazione articoli
    public function create()
    {
        return view('article.create');
    }
    // per il dettaglio degli articoli
    public function show(Article $article){
        
        return view('article.show', compact('article'));
    }
    // da fare per il carrelo
    public function cart()
    {
        return view('article.cart');
    }
    // modifica dell'articolo
    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }
    // profilo amministratore
    public function adminProfile()
    {
        $articles = Article::where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate(6);
        $user = auth()->user();
        return view('admin.profile', compact('articles', 'user'));
    }

    // profilo utente
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
    // elimina articolo
    public function destroy(Article $article)
    {
        $article->delete();
    
        return redirect()->back()->with('success', 'Articolo eliminato con successo.');
    }
    // logica della modifica dell'articolo
    public function update(Request $request, Article $article)
    {
        // Validazione dei dati
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sku' => 'nullable|string|unique:articles,sku,' . $article->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:10',
            'published_at' => 'nullable|date',
            'images.*' => 'image|max:2048',
        ]);

        // Aggiorna l'articolo con i nuovi dati
        $article->update([
            'title' => $validated['title'],
            'sku' => $validated['sku'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'discount' => $validated['discount'],
            'stock' => $validated['stock'],
            'unit' => $validated['unit'],
            
        ]);

        // Gestione delle immagini
        if ($request->hasFile('images')) {
            // Elimina le immagini esistenti
            foreach ($article->images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }

            // Salva le nuove immagini
            foreach ($request->file('images') as $image) {
                $path = $image->store("articles/{$article->id}", 'public');
                $article->images()->create(['path' => $path]);
            }
        }

        // Redirect con messaggio di successo
        return redirect()->route('article.edit', $article->id)
                        ->with('message', 'Articolo aggiornato con successo!');
    }
}
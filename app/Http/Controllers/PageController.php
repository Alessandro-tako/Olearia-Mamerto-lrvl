<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function homepage()
    {
        $articles = Article::all(); // Ottieni tutti gli articoli o personalizza la query
        return view('welcome', compact('articles')); // Passa la variabile alla vista
    }    
    
    public function contacts(){
        return view('contacts');
    }

    public function weAre(){
        return view('chi-siamo');
    }

    public function gallery(){
        return view('galleria');
    }
    // per il form dei contatti
    public function showForm()
    {
        return view('form-contatti');
    }
    
    public function submitForm(Request $request)
    {
        // Valida i dati del modulo
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Invia l'email al team (puoi cambiare questo con l'email desiderata)
        Mail::to('oleariamamerto@gmail.com')->send(new ContactFormMail($validatedData));

        // Puoi anche aggiungere una notifica di successo
        return redirect()->route('contact.form')->with('success', 'Il tuo messaggio è stato inviato con successo!');
    }
}

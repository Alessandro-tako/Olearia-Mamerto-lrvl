<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

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
}

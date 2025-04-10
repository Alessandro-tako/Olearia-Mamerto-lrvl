<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ArticleController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('auth'), // Assicurati che l'utente sia autenticato
            new Middleware('isAdmin', only: ['create']) // Solo gli admin possono creare articoli
        ];
    }



    public function create()
    {
        return view('article.create');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    public function index(){
        $article_to_check = Article::where('is_accepted', NULL)->first();
        return view('admin.revision', compact('article_to_check'));
    }

    public function accept(Article $article)
    {
        $article->setAccepted(true);
        return redirect()->back()->with('message', "hai accettato l'articolo: $article->title");
    }
    public function reject(Article $article)
    {
        $article->setAccepted(false);
        return redirect()->back()->with('message', "Hai rifiutato l'articolo: $article->title");
    }
}
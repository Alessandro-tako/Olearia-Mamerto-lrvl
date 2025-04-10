<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;

class ArticlePreview extends Component
{
    
    public function render()
    {
        $articles = Article::with('images')->latest()->get();

        return view('livewire.article-preview', compact('articles'));
    }
}


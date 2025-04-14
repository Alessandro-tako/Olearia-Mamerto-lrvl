<?php

use App\Livewire\Cart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RevisionController;

Route::get('/', [PageController::class, 'homepage'])->name('homepage');
Route::get('/contatti', [PageController::class, 'contacts'])->name('contacts');
Route::get('/chi-siamo', [PageController::class, 'weAre'])->name('chi-siamo');
Route::get('/galleria', [PageController::class, 'gallery'])->name('galleria');

// rotta per la creazione dei prodotti solo per l'amministratore
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/profilo/admin', [ArticleController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/articles/create', [ArticleController::class, 'create'])->middleware(['auth', 'isAdmin'])->name('article.create');
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::get('/revisor/index', [RevisionController::class, 'index'])->middleware(['auth','isAdmin'])->name('revision.index');
    Route::patch('accept/{article}', [RevisionController::class, 'accept'])->name('accept');
    Route::patch('/reject/{article}', [RevisionController::class, 'reject'])->name('reject');
});

// rotte di visualizzazione degli articoli
Route::get('/articles/index', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/show/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->middleware('auth')->name('article.edit');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->middleware('auth')->name('article.update');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');


// carrello
Route::get('/cart', [ArticleController::class, 'cart'])->name('cart');

// profilo
Route::get('/profilo', [ArticleController::class, 'profile'])->name('user.profile');

// Ricerca
Route::get('/search/article', [ArticleController::class, 'searchArticles'])->name('article.search');
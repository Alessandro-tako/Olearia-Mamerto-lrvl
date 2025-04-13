<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;

Route::get('/', [PageController::class, 'homepage'])->name('homepage');
Route::get('/contatti', [PageController::class, 'contacts'])->name('contacts');
Route::get('/chi-siamo', [PageController::class, 'weAre'])->name('chi-siamo');
Route::get('/galleria', [PageController::class, 'gallery'])->name('galleria');

// rotta per la creazione dei prodotti solo per l'amministratore
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])
    ->middleware(['auth', 'isAdmin'])
    ->name('article.create');
    Route::post('/articles', [ArticleController::class, 'store']);
});


Route::get('/articles/index', [ArticleController::class, 'index'])->name('article.index');

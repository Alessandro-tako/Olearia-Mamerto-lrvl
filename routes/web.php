<?php

use App\Livewire\Cart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\ShippingAddressController;

Route::get('/', [PageController::class, 'homepage'])->name('homepage');
Route::get('/contatti', [PageController::class, 'contacts'])->name('contacts');
Route::get('/chi-siamo', [PageController::class, 'weAre'])->name('chi-siamo');
Route::get('/galleria', [PageController::class, 'gallery'])->name('galleria');

// rotta per la creazione dei prodotti solo per l'amministratore
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/profilo/admin', [ArticleController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::get('/revisor/index', [RevisionController::class, 'index'])->name('revision.index');
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
Route::middleware('auth')->group(function() {
    Route::get('cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('cart/{article}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('cart/update/{cartId}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
});

// profilo
Route::get('/profilo', [ArticleController::class, 'profile'])->name('user.profile');

// elementi per la spedizione
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/shipping-address', [ShippingAddressController::class, 'edit'])->name('user.shipping');
    Route::put('/profile/shipping-address', [ShippingAddressController::class, 'update'])->name('shipping.update');
});

// Ricerca
Route::get('/search/article', [ArticleController::class, 'searchArticles'])->name('article.search');

// pagamento
Route::middleware(['auth'])->group(function () {
    // Aggiungi qui la validazione che l'utente abbia compilato il form di spedizione
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('paypal.checkout');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
    Route::get('/shipping', [PaymentController::class, 'showShippingForm'])->name('shipping.form');
    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
});

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'quantity',
        'price'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Metodo per contare gli articoli nel carrello dell'utente autenticato
    public static function itemCount()
    {
        return Cart::where('user_id', Auth::id())->sum('quantity');
    }
}

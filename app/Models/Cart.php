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
        $user = Auth::user();

        if (!$user) {
            return 0;
        }

        return self::where('user_id', $user->id)->count();
    }
}

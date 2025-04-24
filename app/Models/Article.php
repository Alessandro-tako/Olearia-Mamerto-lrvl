<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Article;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'title',
        'sku',
        'image',
        'description',
        'price',
        'discount',
        'stock',
        'unit',
        'is_active',
        'slug',
        'published_at',
    ];

    /**
     * Relazione con l'utente (proprietario dell'articolo)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public static function toBeRevisedCount()
    {
        return Article::where('is_accepted', null)->count();
    }

    
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }

    public function toSearchableArray()
    {
        return [
            'id'=>$this->id,
            'title' =>$this->title,
            'description'=>$this->description,
            'price' => $this->price,
        ];
    }
}

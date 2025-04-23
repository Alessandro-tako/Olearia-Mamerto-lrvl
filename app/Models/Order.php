<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItem;
use Laravel\Scout\Searchable;
use App\Models\ShippingAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use Searchable;
    
    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'total_amount',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => $this->user_name,  // Nome utente personalizzato
            'email' => $this->user_email, // Email utente personalizzato
        ]);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Metodo per calcolare il totale dell'ordine
    public function calculateTotal()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->price * $item->quantity;
        }

        return $total;
    }

    public function shippingAddress()
    {
        return $this->user->shippingAddress;
    }
    

    public static function newOrdersCount()
    {
        return self::where('status', 'Pagato e in attesa')->count();
    }

    public function toSearchableArray()
{
    return [
        'id' => $this->id,
        'status' => $this->status,
        'total_amount' => $this->total_amount,
        'user_email' => optional($this->user)->email,
    ];
}



}

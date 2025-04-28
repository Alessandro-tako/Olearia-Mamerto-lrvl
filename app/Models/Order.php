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
            'name' => $this->user_name,
            'email' => $this->user_email,
        ]);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shippingAddress()
    {
        return $this->user->shippingAddress;
    }

    public function calculateTotal()
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public static function newOrdersCount()
    {
        return self::where('status', 'Pagato e in attesa')->count();
    }

    // Miglioramento della ricerca
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'order_id' => 'Ordine #' . $this->id, // Rende visibile l'ID con il prefisso "Ordine #"
            'plain_order_id' => $this->id, // Campo per ricerca numerica
            'status' => $this->status,
            'user_name' => $this->user_name ?? optional($this->user)->name,
            'user_email' => $this->user_email ?? optional($this->user)->email,
            'total_amount' => $this->total_amount,
            'formatted_total' => number_format($this->total_amount, 2, ',', '.') . ' €',
            'created_at_formatted' => optional($this->created_at)->format('d/m/Y H:i'),
        ];
    }
}

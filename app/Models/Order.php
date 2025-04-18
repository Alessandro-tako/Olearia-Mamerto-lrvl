<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_amount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
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


}

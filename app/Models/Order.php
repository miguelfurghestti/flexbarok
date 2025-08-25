<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_number',
        'status',
        'order_owner_name',
        'id_shop',
        'total_amount',
        'opened_at',
        'closed_at',
    ];

    protected $casts = [
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'id_shop');
    }

    public function products()
    {
        return $this->hasMany(OrderProducts::class, 'id_order');
    }

    public function scopeByShop($query, $shopId)
    {
        return $query->where('id_shop', $shopId);
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    public function calculateTotal()
    {
        return $this->products->sum(function ($orderProduct) {
            return $orderProduct->unit_price * $orderProduct->quantity;
        });
    }
}

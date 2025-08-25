<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;

    protected $table = 'order_products';

    protected $fillable = [
        'id_order',
        'id_shop',
        'id_product',
        'quantity',
        'unit_price',
        'notes',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'id_shop', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'id_product', 'id');
    }

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->unit_price;
    }
}

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
        'id_product'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
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
}

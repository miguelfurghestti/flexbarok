<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableProducts extends Model
{
    use HasFactory;

    protected $table = 'table_products';

    protected $fillable = [
        'id_table',
        'id_shop',
        'id_product',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function table()
    {
        return $this->belongsTo(Tables::class, 'id_table', 'id');
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
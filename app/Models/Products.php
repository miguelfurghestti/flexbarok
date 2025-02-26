<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'id_category',
        'id_shop',
        'qty',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'id_shop', 'id');
    }

    public function category()
    {
        return $this->belongsTo(ProductsCategorys::class, 'id_category', 'id');
    }
}
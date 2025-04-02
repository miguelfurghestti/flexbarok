<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Products extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            if ($product->image) {
                $imagePath = str_replace('storage/', '', $product->image);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        });
    }

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'id_category',
        'id_shop',
        'image',
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

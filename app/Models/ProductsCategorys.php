<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductsCategorys extends Model
{
    use HasFactory;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'products_categorys';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'icon',
        'id_shop',
    ];

    /**
     * Os atributos que devem ser ocultados ao serializar o modelo.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Gera slug automaticamente ao criar a categoria
     *
     * @var array
     */
    protected static function booted()
    {
        static::creating(function ($category) {
            $originalSlug = Str::slug($category->name);
            $slug = $originalSlug;
            $count = 1;

            // Verifica se o slug já existe e incrementa se necessário
            while (ProductsCategorys::where('slug', $slug)->where('id_shop', $category->id_shop)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $category->slug = $slug;
        });

        static::updating(function ($category) {
            $originalSlug = Str::slug($category->name);
            $slug = $originalSlug;
            $count = 1;

            while (ProductsCategorys::where('slug', $slug)->where('id_shop', $category->id_shop)->where('id', '!=', $category->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $category->slug = $slug;
        });
    }

    /**
     * Os relacionamentos do modelo.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'id_shop', 'id');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'id_category', 'id');
    }
}
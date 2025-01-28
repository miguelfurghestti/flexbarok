<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * Os relacionamentos do modelo.
     */
    public function shop()
    {
        return $this->belongsTo(Shops::class, 'id_shop', 'id');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'id_category', 'id');
    }
}

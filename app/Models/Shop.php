<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'shops';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user',
        'address',
        'number',
        'city',
        'cnpj',
        'phone',
        'email',
        'website',
        'type_sell',
        'modules',
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

    // Exemplo: Relacionamento com o modelo User (1 loja pertence a 1 usuário)
    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    // Relacionamento com produtos
    public function products()
    {
        return $this->hasMany(Products::class, 'id_shop', 'id');
    }

    public function customers()
    {
        return $this->hasMany(Customers::class, 'id_shop', 'id');
    }

    public function courts()
    {
        return $this->hasMany(Court::class, 'id_shop', 'id');
    }

    // Relacionamento com categorias de produtos
    public function productCategories()
    {
        return $this->hasMany(ProductsCategorys::class, 'id_shop', 'id');
    }
}
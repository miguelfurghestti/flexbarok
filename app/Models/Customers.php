<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'id_shop',
        'cpf',
        'cnpj',
        'name',
        'phone',
        'email',
        'address',
        'number',
        'city',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'id_shop', 'id');
    }
}
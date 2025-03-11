<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
    ];

    public function courts()
    {
        return $this->hasMany(Court::class, 'id_sport', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courts extends Model
{
    use HasFactory;

    protected $table = 'courts';

    protected $fillable = [
        'id_sport',
        'name',
        'status',
    ];

    public function sport()
    {
        return $this->belongsTo(Sports::class, 'id_sport', 'id');
    }
}

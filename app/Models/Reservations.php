<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'owner_name',
        'id_court',
        'date',
        'use_grill',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function court()
    {
        return $this->belongsTo(Court::class, 'id_court', 'id');
    }
}
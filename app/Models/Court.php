<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    protected $table = 'courts';

    protected $fillable = [
        'id_sport',
        'id_shop',
        'name',
        'status',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'id_sport', 'id');
    }
}

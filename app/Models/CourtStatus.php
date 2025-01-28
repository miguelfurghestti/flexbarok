<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtStatus extends Model
{
    use HasFactory;

    protected $table = 'court_status';

    protected $fillable = [
        'id_court',
        'owner_name',
        'starts',
        'ends',
        'status'
    ];

    public function court()
    {
        return $this->belongsTo(Courts::class, 'id_court', 'id');
    }
}

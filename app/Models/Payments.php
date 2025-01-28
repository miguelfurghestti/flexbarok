<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'order_number',
        'payment_type',
        'value'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}

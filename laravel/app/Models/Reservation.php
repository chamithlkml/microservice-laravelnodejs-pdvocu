<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_code',
        'customer_name',
        'customer_email',
        'arrival_time',
        'departure_time',
        'payment_status',
    ];
}

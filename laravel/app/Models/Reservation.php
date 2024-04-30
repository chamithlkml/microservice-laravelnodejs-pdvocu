<?php

namespace App\Models;

use App\Services\ReservationQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\Services\ReservationQueueRabbitmq;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected static function booted(): void
    {
        static::saved(function (Reservation $reservation){
            // If payment_status is changed and current value is = paid
            if($reservation->isDirty('payment_status') && $reservation->payment_status == 'paid'){
                Log::info('Paid reservation: ' . $reservation->id);
                $reservationQueue = new ReservationQueueRabbitmq(env('RABBITMQ_RESERVATION_QUEUE'));
                $reservationQueue->sendMessge($reservation);

                // SQS implementation
                // $reservationQueue = new ReservationQueue(env('AWS_RESERVATION_QUEUE'));
                // $reservationQueue->sendMessage($reservation);
            }
        });
    }
}

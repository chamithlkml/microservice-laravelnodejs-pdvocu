<?php

namespace App\Services;

use Aws\Sqs\SqsClient;
use App\Models\Reservation;
use Exception;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Log;

class ReservationQueue
{
  public function __construct(
    private string $queueUrl,
  ){}

  /**
   * Push a message to AWS SQS Queue
   *
   * @param Reservation $reservation
   * @return void
   */
  public function sendMessage(Reservation $reservation)
  {
      $client = new SqsClient([
        'version' => 'latest',
        'region' => env('AWS_DEFAULT_REGION'),
      ]);

      $message = json_encode([
        'message' => 'reservation_paid',
        'reservation' => $reservation
      ]);
  
      $result = $client->sendMessage([
        'QueueUrl' => $this->queueUrl,
        'MessageBody' => $message
      ]);


    $client = new SqsClient([
      'version' => 'latest',
      'region' => env('AWS_DEFAULT_REGION'),
    ]);

  }
}
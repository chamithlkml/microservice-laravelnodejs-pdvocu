<?php

namespace App\Services;

use App\Models\Reservation;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ReservationQueueRabbitmq
{
  public function __construct(
    private string $queueName
  ){}

  public function sendMessge(Reservation $reservation){
    $connection = new AMQPStreamConnection(
      env('RABBITMQ_HOST'),
      env('RABBITMQ_PORT'),
      env('RABBITMQ_USER'),
      env('RABBITMQ_PASSWORD'),
      '/'
    );
    $channel = $connection->channel();
    
    $channel->exchange_declare(env('RABBITMQ_EXCHANGE'), 'direct', false, false, false);
    $channel->queue_declare($this->queueName, false, false, false, false);
    $channel->queue_bind($this->queueName, env('RABBITMQ_EXCHANGE'), env('RABBITMQ_ROUTING_KEY'));
    
    $message = json_encode($reservation);

    $amqpMessage = new AMQPMessage($message);
    $channel->basic_publish($amqpMessage, env('RABBITMQ_EXCHANGE'), env('RABBITMQ_ROUTING_KEY'));
    Log::info('Sent message Rabbitmq queue: ' . $message);
    
    $channel->close();
    $connection->close();
  }
}
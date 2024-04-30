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

  public function sendMessge(string $message){
    $connection = new AMQPStreamConnection(
      env('RABBITMQ_HOST'),
      env('RABBITMQ_PORT'),
      env('RABBITMQ_USER'),
      env('RABBITMQ_PASSWORD'),
      '/'
    );
    $channel = $connection->channel();
    
    $channel->exchange_declare('test_exchange', 'direct', false, false, false);
    $channel->queue_declare($this->queueName, false, false, false, false);
    $channel->queue_bind($this->queueName, 'test_exchange', 'test_key');
    
    $amqpMessage = new AMQPMessage($message);
    $channel->basic_publish($amqpMessage, 'test_exchange', 'test_key');
    Log::info('Sent message to test_exchange/' . $this->queueName);
    
    $channel->close();
    $connection->close();
  }
}
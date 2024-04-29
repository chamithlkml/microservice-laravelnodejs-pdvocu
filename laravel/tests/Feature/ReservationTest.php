<?php

use App\Models\User;
use Tests\TestCase;
use Faker\Factory as Faker;

class ReservationTest extends TestCase
{
  public function test_create_product_api(){
    $faker = Faker::create();
    $reservationData = [
      'reservation_code' => $faker->uuid(),
      'customer_name' => $faker->name(),
      'customer_email' => $faker->email(),
      'arrival_time' => date('Y-m-d H:i:s', strtotime('+1 day')),
      'departure_time' => date('Y-m-d H:i:s'),
      'payment_status' => 'pending',
    ];
    $response = $this->withHeaders([
      'Accept' => 'Application/json'
    ])->post('/api/reservations', $reservationData);
    $response->assertStatus(200);
  }

  public function test_get_all_products_api(){

  }

  public function test_get_product_api(){
    
  }
}
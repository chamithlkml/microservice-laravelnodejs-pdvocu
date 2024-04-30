<?php

use App\Models\User;
use Tests\TestCase;
use Faker\Factory as Faker;

class ReservationTest extends TestCase
{
  /**
   * Testing POST /api/reservations
   *
   * @return void
   */
  public function test_create_reservation_api(){
    $user = User::factory()->create();
    $accessToken = $user->createToken('access-token-' . $user->id)->plainTextToken;
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
      'Accept' => 'Application/json',
      'Authorization' => 'Bearer ' . $accessToken
    ])->post('/api/reservations', $reservationData);
    $response->assertStatus(200);
  }

  // public function test_get_all_reservations_api(){

  // }

  // public function test_get_reservations_api(){
    
  // }

  // public function test_update_reservations_api(){
    
  // }
}
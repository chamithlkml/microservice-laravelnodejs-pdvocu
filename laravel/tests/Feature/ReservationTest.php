<?php

use App\Models\Reservation;
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
      'customer_name' => $faker->name(),
      'customer_email' => $faker->email(),
      'arrival_time' => date('Y-m-d H:i:s', strtotime('+1 day')),
      'departure_time' => date('Y-m-d H:i:s')
    ];
    $response = $this->withHeaders([
      'Accept' => 'Application/json',
      'Authorization' => 'Bearer ' . $accessToken
    ])->post('/api/reservations', $reservationData);
    $response->assertStatus(200);
  }

  /**
   * Test GET /api/reservations
   *
   * @return void
   */
  public function test_get_all_reservations_api(){
    $user = User::factory()->create();
    $accessToken = $user->createToken('access-token-' . $user->id)->plainTextToken;
    $response = $this->withHeaders([
      'Accept' => 'Application/json',
      'Authorization' => 'Bearer ' . $accessToken
    ])->get('/api/reservations');

    $response->assertStatus(200);
  }

  /**
   * GET /api/reservations/:id
   *
   * @return void
   */
  public function test_get_reservations_api(){
    $user = User::factory()->create();
    $accessToken = $user->createToken('access-token-' . $user->id)->plainTextToken;
    $reservation = Reservation::factory()->create();
    $response = $this->withHeaders([
      'Accept' => 'Application/json',
      'Authorization' => 'Bearer ' . $accessToken
    ])->get("/api/reservations/{$reservation->id}");

    $response->assertStatus(200);
  }

  /**
   * PUT /api/reservations/:id
   *
   * @return void
   */
  public function test_update_reservations_api(){
    $user = User::factory()->create();
    $accessToken = $user->createToken('access-token-' . $user->id)->plainTextToken;
    $reservation = Reservation::factory()->create();
    $reservationData = [
      'payment_status' => 'paid'
    ];
    $response = $this->withHeaders([
      'Accept' => 'Application/json',
      'Authorization' => 'Bearer ' . $accessToken
    ])->put("/api/reservations/{$reservation->id}", $reservationData);

    $response->assertStatus(200);
  }
}
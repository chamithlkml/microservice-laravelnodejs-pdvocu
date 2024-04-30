<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reservation_code' => uniqid(),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->email(),
            'arrival_time' => date('Y-m-d H:i:s', strtotime('+1 day')),
            'departure_time' => date('Y-m-d H:i:s'),
            'payment_status' => 'pending'
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'reservation_date' => $this->faker->dateTimeBetween('-30 days'),
            'approved_at' => $this->faker->dateTimeBetween('-30 days'),
        ];
    }
}

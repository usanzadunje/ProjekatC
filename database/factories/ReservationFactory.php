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
            'reservation_date' => $this->faker->dateTimeBetween('now', '+360 days'),
            'number_of_guests' => $this->faker->numberBetween(10, 200),
            'occasion' => $this->faker->word,
            'additional_requirements' => $this->faker->realText(),
            'approved_at' => rand(0, 1) ? $this->faker->dateTimeBetween('now', '+360 days') : null,
        ];
    }
}

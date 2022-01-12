<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'name' => ucwords($this->faker->word),
            'city' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),
        ];
    }
}

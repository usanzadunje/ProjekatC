<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure() {
        return $this->afterCreating(function(Place $place) {
            $place
                ->offers()
                ->saveMany(Offer::factory(5)->make());
        });
    }

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

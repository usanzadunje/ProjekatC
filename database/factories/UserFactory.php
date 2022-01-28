<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\OfferReservation;
use App\Models\Place;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure() {
        return $this->afterCreating(function(User $user) {
            if($user->hasRole('regular')) {
                $places = Place::where('id', '<', 10)->pluck('id');
                $reservations = Reservation::factory(5)->make()->toArray();

                foreach($reservations as $reservation){
                    $user
                        ->reservations()
                        ->attach(
                            $places->random(),
                            $reservation
                        );
                }
            }
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => Role::REGULAR,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified() {
        return $this->state(function(array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model's avatar should be avatar.png(default value).
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withAvatar() {
        return $this->state(function(array $attributes) {
            return [
                'avatar' => $this->faker->image(
                    storage_path('app/public/img/avatars'),
                    50, 50,
                    null, false
                ),
            ];
        });
    }

    /**
     * Indicate that the user is admin.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function admin() {
        return $this->state(function(array $attributes) {
            return [
                'role_id' => Role::ADMIN,
            ];
        });
    }

    /**
     * Indicate that the user is staff.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function staff() {
        return $this->state(function(array $attributes) {
            return [
                'role_id' => Role::STAFF,
            ];
        });
    }

    /**
     * Indicate that the user is regular.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function regular() {
        return $this->state(function(array $attributes) {
            return [
                'role_id' => Role::REGULAR,
            ];
        });
    }
}

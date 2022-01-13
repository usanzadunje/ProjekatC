<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar' => 'avatar.png',
            'remember_token' => Str::random(10),
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
                'avatar' => $this->faker->image(storage_path('app/public/avatars'), 50, 50, null, false),
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
                'first_name' => 'Dusan',
                'last_name' => 'Djordjevic',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$9f1D5..uClldN95s/kzB9uOIlLhs6mmJYEW43LNv6qUrWHdwbTf92', // admin
                'remember_token' => Str::random(10),
                'role_id' => 1,
            ];
        });
    }
}

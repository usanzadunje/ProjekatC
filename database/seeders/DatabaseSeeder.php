<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // Removing all images and regenerating folder they reside in
        Storage::disk('public')->deleteDirectory('img');
        Storage::disk('public')->makeDirectory('img/avatars');
        Storage::disk('public')->makeDirectory('img/places');

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ReservationSeeder::class,
            ImageSeeder::class,
        ]);
    }
}

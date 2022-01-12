<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::factory(1)->admin()->create();
        User::factory(4)->hasPlace()->create();
        User::factory(5)->create();
    }
}

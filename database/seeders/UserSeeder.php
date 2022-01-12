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
        User::factory(1)->withAvatar()->admin()->create();
        User::factory(4)->withAvatar()->hasPlace()->create();
        User::factory(5)->withAvatar()->create();
    }
}

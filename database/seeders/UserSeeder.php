<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->createCustomAdmin();
        User::factory(4)->withAvatar()->staff()->hasPlace()->create();
        User::factory(5)->withAvatar()->create();
    }

    private function createCustomAdmin(){
        User::create([
            'first_name' => 'Dusan',
            'last_name' => 'Djordjevic',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$9f1D5..uClldN95s/kzB9uOIlLhs6mmJYEW43LNv6qUrWHdwbTf92', // admin
            'remember_token' => Str::random(10),
            'role_id' => 1,
        ]);
    }
}

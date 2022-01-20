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
        User::factory(1)->withAvatar()->admin()->create([
            'first_name' => 'Dusan',
            'last_name' => 'Djordjevic',
            'username' => 'admin',
            'email' => 'admin@admin.com',
        ]);

        User::factory(4)->withAvatar()->staff()->hasPlace()->create();

        User::factory(1)->withAvatar()->regular()->create([
            'first_name' => 'Regular',
            'last_name' => 'Regular',
            'username' => 'regular',
            'email' => 'regular@regular.com',
        ]);

        User::factory(4)->withAvatar()->create();
    }
}

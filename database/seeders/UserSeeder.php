<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $admin = User::factory(1)->withAvatar()->admin()->create([
            'first_name' => 'Dusan',
            'last_name' => 'Djordjevic',
            'username' => 'admin',
            'email' => 'admin@admin.com',
        ])[0];

        User::factory(13)->staff()->hasPlace()->create();

        User::factory(1)->withAvatar()->regular()->create([
            'first_name' => 'Regular',
            'last_name' => 'Regular',
            'username' => 'regular',
            'email' => 'regular@regular.com',
        ]);

        User::factory(4)->create();

        // Generating default avatar.png image
        Storage::disk('public')->copy("img/avatars/$admin->avatar", "img/avatars/avatar.png");
    }
}

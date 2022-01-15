<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $regularUsers = User::where('role_id', Role::REGULAR)->get();
        $places = Place::pluck('id');

        $regularUsers->each(function(User $user) use ($places) {
            $user
                ->reservations()
                ->attach(
                    $places->random(),
                    ['reservation_date' => Carbon::now()->addHours(rand(1, 1000))],
                );
        });
    }
}

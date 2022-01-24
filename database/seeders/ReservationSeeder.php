<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\User;
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
        $places = Place::where('id', '<', 10)->pluck('id');

        $regularUsers->each(function(User $user) use ($places) {
            $reservations = Reservation::factory(10)->make()->toArray();

            foreach($reservations as $reservation){
                $user
                    ->reservations()
                    ->attach(
                        $places->random(),
                        $reservation
                    );
            }
        });
    }
}

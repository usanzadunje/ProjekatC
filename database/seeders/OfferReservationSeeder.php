<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\OfferReservation;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class OfferReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $reservations = Reservation::all('id', 'place_id');

        $reservations->each(function(Reservation $reservation) {
            $requests = OfferReservation::factory(3)->make()->toArray();
            $offers = Offer::where('place_id', $reservation->place_id)->pluck('id');

            foreach($requests as $request){
                $reservation
                    ->offers()
                    ->attach(
                        $offers->random(),
                        $request
                    );
            }
        });
    }
}

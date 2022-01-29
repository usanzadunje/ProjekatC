<?php

namespace App\Actions\Reservation\Regular;

use App\Models\Reservation;

class UpdateReservationAction
{
    public function handle(Reservation $reservation, array $reservationData): void {
        $updatedOffers = [];

        if(array_key_exists('offers', $reservationData)) {
            $updatedOffers = $reservationData['offers'];
            unset($reservationData['offers']);
        }

        $existingOffers = $reservation->offers()->pluck('offers.id')->toArray();

        $newlyAddedOffers = array_diff($updatedOffers, $existingOffers);
        $removedOffers = array_diff($existingOffers, $updatedOffers);

        $reservation->offers()->attach($newlyAddedOffers);
        $reservation->offers()->detach($removedOffers);

        $reservation->update($reservationData);
    }
}
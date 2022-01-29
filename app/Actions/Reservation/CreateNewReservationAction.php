<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use App\Models\User;

class CreateNewReservationAction
{
    public function handle(User $user, array $reservationData): void {
        $reservationData['user_id'] = $user->id;
        $offers = null;

        if(array_key_exists('offers', $reservationData)) {
            $offers = $reservationData['offers'];
            unset($reservationData['offers']);
        }

        $createdReservation = Reservation::create($reservationData);
        $createdReservation->offers()->attach($offers);
    }
}
<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CreateNewReservationAction
{
    public function handle(User $user, array $reservationData): void {
        if($user->hasRole('regular')) {
            $user->reservations()->attach($reservationData['place_id'], $reservationData);
        }else {
            $user->place()->reservees()->attach($reservationData['user_id'], $reservationData);
        }
    }

}
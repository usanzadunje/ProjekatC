<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;

class GetRegularReservationsAction
{
    public function handle(User $user, string $filter = ''): Paginator {
        return Reservation::select([
            'reservations.id', 'reservations.reservation_date', 'reservations.approved_at', 'reservations.created_at', 'reservations.place_id',
            'reservations.number_of_guests',
            'places.id as placeId', 'places.name as place_name', 'places.address as place_address',
        ])
            ->join('places', 'places.id', '=', 'reservations.place_id')
            ->where('reservations.user_id', $user->id)
            ->filter($filter, ['places.name', 'places.address', 'places.city'])
            ->orderByDesc('reservations.created_at')
            ->simplePaginate(5);
    }
}
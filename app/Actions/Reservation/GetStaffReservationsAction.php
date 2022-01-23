<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;

class GetStaffReservationsAction
{
    public function handle(User $user, string $filter = ''): Paginator {
        return Reservation::select([
            'reservations.id', 'reservations.reservation_date', 'reservations.approved_at', 'reservations.created_at', 'reservations.user_id',
            'users.first_name as user_first_name', 'users.last_name as user_last_name', 'users.email as user_email',
        ])
            ->join('users', 'users.id', '=', 'reservations.user_id')
            ->where('reservations.place_id', $user->place()->value('id'))
            ->filter($filter, ['users.first_name', 'users.last_name', 'users.email'])
            ->orderByDesc('reservations.created_at')
            ->simplePaginate(5);
    }

}
<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class GetReservationsAction
{
    public function handle(User $user) {
        return Reservation::exclude('updated_at')
            ->when(
                $user->role === Role::REGULAR,
                fn(Builder $query) => $query->where('user_id', $user->id)->with('place'),
                fn(Builder $query) => $query->where('place_id', $user->place()->value('id'))->with('reservee'),
            )
            ->orderByDesc('created_at')
            ->get();
    }

}
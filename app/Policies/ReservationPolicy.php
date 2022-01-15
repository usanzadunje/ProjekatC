<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function viewAny(User $user): bool {
        return $user->hasAnyRole(['staff', 'regular']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Reservation $reservation
     * @return bool
     */
    public function view(User $user, Reservation $reservation): bool {
        $isAuthUserReservation = $user->id === $reservation->user_id;
        $isReservationBelongingToStaffPlace = $user->place()->value('id') === $reservation->user_id;

        return $isAuthUserReservation || $isReservationBelongingToStaffPlace;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function create(User $user): bool {
        return $user->hasAnyRole(['staff', 'regular']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Reservation $reservation
     * @return bool
     */
    public function update(User $user, Reservation $reservation): bool {
        $isAuthUserReservation = $user->id === $reservation->user_id;
        $isReservationBelongingToStaffPlace = $user->place()->value('id') === $reservation->user_id;

        return $isAuthUserReservation || $isReservationBelongingToStaffPlace;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Reservation $reservation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Reservation $reservation): bool {
        $isAuthUserReservation = $user->id === $reservation->user_id;
        $isReservationBelongingToStaffPlace = $user->place()->value('id') === $reservation->user_id;

        return $isAuthUserReservation || $isReservationBelongingToStaffPlace;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Reservation $reservation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Reservation $reservation) {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Reservation $reservation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Reservation $reservation) {
        //
    }
}

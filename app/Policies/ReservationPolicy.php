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
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool {
        return $user->hasAnyRole(['staff', 'regular']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Reservation $reservation
     * @return bool
     */
    public function view(User $user, Reservation $reservation): bool {
        return $this->isRegularReservationOrBelongsToStaffPlace($user, $reservation);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool {
        return $user->hasAnyRole(['staff', 'regular']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Reservation $reservation
     * @return bool
     */
    public function update(User $user, Reservation $reservation): bool {
        return $this->isRegularReservationOrBelongsToStaffPlace($user, $reservation);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Reservation $reservation
     * @return bool
     */
    public function delete(User $user, Reservation $reservation): bool {
        return $this->isRegularReservationOrBelongsToStaffPlace($user, $reservation);
    }

    /**
     * Checks whether reservation belongs to regular user or reservation is made for place that
     * staff is working for
     *
     * @param User $user
     * @param Reservation $reservation
     * @return bool
     */
    private function isRegularReservationOrBelongsToStaffPlace(User $user, Reservation $reservation): bool {
        $isRegularUserReservation = $user->id === $reservation->user_id;
        $isReservationBelongingToStaffPlace = $user->place()->value('id') === $reservation->place_id;

        return $isRegularUserReservation || $isReservationBelongingToStaffPlace;
    }
}

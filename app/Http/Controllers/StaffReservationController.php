<?php

namespace App\Http\Controllers;

use App\Actions\Reservation\GetStaffReservationsAction;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class StaffReservationController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Reservation::class, 'reservation');
    }

    public function index(GetStaffReservationsAction $getStaffReservationsAction): InertiaResponse {
        $filter = request('filter') ?? '';

        $reservations = $getStaffReservationsAction->handle(auth()->user(), $filter);

        return Inertia::render('Reservations/Staff/Index', compact('reservations'));
    }

    public function show(Reservation $reservation) {
        //
    }

    public function edit(Reservation $reservation) {
        //
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation) {
        //
    }
}

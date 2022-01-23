<?php

namespace App\Http\Controllers;

use App\Actions\Reservation\CreateNewReservationAction;
use App\Actions\Reservation\GetStaffReservationsAction;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
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

    public function create(): InertiaResponse {
        return Inertia::render('Reservations/Staff/Create');
    }

    public function store(StoreReservationRequest $request, CreateNewReservationAction $createNewReservationAction): RedirectResponse {
        $createNewReservationAction->handle(auth()->user(), $request->validated());

        return redirect()->route('staff.reservation.index');
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

    public function destroy(Reservation $reservation): RedirectResponse {
        $reservation->delete();

        return redirect()->route('staff.reservation.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Actions\Reservation\CreateNewReservationAction;
use App\Actions\Reservation\GetRegularReservationsAction;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Place;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;


class RegularReservationController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Reservation::class, 'reservation');
    }

    public function index(GetRegularReservationsAction $getRegularReservationsAction): InertiaResponse {
        $filter = request('filter') ?? '';

        $reservations = $getRegularReservationsAction->handle(auth()->user(), $filter);

        return Inertia::render('Reservations/Regular/Index', compact('reservations'));
    }

    public function create(Place $place): InertiaResponse {
        return Inertia::render('Reservations/Regular/Create', compact('place'));
    }

    public function store(StoreReservationRequest $request, CreateNewReservationAction $createNewReservationAction): RedirectResponse {
        $createNewReservationAction->handle(auth()->user(), $request->validated());

        return redirect()->route('regular.reservation.index');
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

        return redirect()->back();
    }
}

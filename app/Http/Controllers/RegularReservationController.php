<?php

namespace App\Http\Controllers;

use App\Actions\Reservation\CreateNewReservationAction;
use App\Actions\Reservation\Regular\GetReservationsAction;
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

    public function index(GetReservationsAction $getReservationsAction): InertiaResponse {
        $filter = request('filter') ?? '';

        $reservations = $getReservationsAction->handle(auth()->user(), $filter);

        return Inertia::render('Reservations/Regular/Index', compact('reservations'));
    }

    public function create(Place $place): InertiaResponse {
        return Inertia::render('Reservations/Regular/CreateEdit', ['place' => $place->only('id', 'name')]);
    }

    public function store(StoreReservationRequest $request, CreateNewReservationAction $createNewReservationAction): RedirectResponse {
        $createNewReservationAction->handle(auth()->user(), $request->validated());

        return redirect()->route('regular.reservation.index');
    }

    public function show(Reservation $reservation) {
        return Inertia::render('Reservations/Regular/Show', ['reservation' => $reservation->load('place')]);
    }

    public function edit(Reservation $reservation, Place $place): InertiaResponse {
        $place->reservation = $reservation->only('id', 'occasion', 'number_of_guests', 'reservation_date', 'additional_requirements');

        return Inertia::render('Reservations/Regular/CreateEdit', ['place' => $place->only('id', 'name', 'reservation')]);
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation): RedirectResponse {

        $reservation->update($request->validated());

        return redirect()->route('regular.reservation.show', $reservation->id);
    }

    public function destroy(Reservation $reservation): RedirectResponse {
        $reservation->delete();

        return redirect()->back();
    }
}

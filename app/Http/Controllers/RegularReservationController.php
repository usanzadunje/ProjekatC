<?php

namespace App\Http\Controllers;

use App\Actions\Reservation\Regular\CreateNewReservationAction;
use App\Actions\Reservation\Regular\GetReservationsAction;
use App\Actions\Reservation\Regular\UpdateReservationAction;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\OfferReservation;
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
        return Inertia::render('Reservations/Regular/CreateEdit', [
            'place' => $place
                ->load('offers')
                ->only('id', 'name', 'offers'),
        ]);
    }

    public function store(StoreReservationRequest $request, CreateNewReservationAction $createNewReservationAction): RedirectResponse {
        $createNewReservationAction->handle(auth()->user(), $request->validated());

        return redirect()->route('regular.reservation.index');
    }

    public function show(Reservation $reservation): InertiaResponse {
        return Inertia::render('Reservations/Regular/Show', [
            'reservation' => $reservation
                ->load('place')
                ->load('offers'),
        ]);
    }

    public function edit(Reservation $reservation, Place $place): InertiaResponse {
        $place->reservation = $reservation
            ->load('offers')
            ->only('id', 'occasion', 'number_of_guests', 'reservation_date', 'additional_requirements', 'offers');

        return Inertia::render('Reservations/Regular/CreateEdit', [
            'place' => $place
                ->load('offers')
                ->only('id', 'name', 'reservation', 'offers'),
        ]);
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation, UpdateReservationAction $updateReservationAction) {
        $updateReservationAction->handle($reservation, $request->validated());

        return redirect()->route('regular.reservation.show', $reservation->id);
    }

    public function destroy(Reservation $reservation): RedirectResponse {
        $reservation->delete();

        return redirect()->back();
    }
}

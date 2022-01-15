<?php

namespace App\Http\Controllers;

use App\Actions\Reservation\CreateNewReservationAction;
use App\Actions\Reservation\GetReservationsAction;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class StaffReservationController extends Controller
{
    public function index(GetReservationsAction $getReservationsAction): InertiaResponse {
        $reservations = $getReservationsAction->handle(auth()->user());


        return Inertia::render('Reservations/Staff/Index', compact('reservations'));
    }

    public function create(): InertiaResponse {
        return Inertia::render('Reservations/Staff/Create');
    }

    public function store(StoreReservationRequest $request, CreateNewReservationAction $createNewReservationAction): InertiaResponse {
        $createNewReservationAction->handle(auth()->user(), $request->validated());

        return Inertia::render('Reservations/Staff/Index');
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

    public function destroy(Reservation $reservation) {
        //
    }
}

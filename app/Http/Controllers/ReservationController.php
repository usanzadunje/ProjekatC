<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return InertiaResponse
     */
    public function index(): InertiaResponse {
        // REFACTOR
        // Mora da bude paginated
        $userIsRegular = auth()->user()->role === Role::REGULAR;

        $reservations = Reservation::exclude('updated_at')
            ->when(
                $userIsRegular,
                fn(Builder $query) => $query->where('user_id', auth()->id)->with('place'),
                fn(Builder $query) => $query->where('place_id', auth()->user()->place()->value('id'))->with('reservee')
            )
            ->orderByDesc('created_at')
            ->get();

        return $userIsRegular ?
            Inertia::render('Reservations/Regular/Index', compact('reservations')) :
            Inertia::render('Reservations/Staff/Index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreReservationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationRequest $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateReservationRequest $request
     * @param \App\Models\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation) {
        //
    }
}

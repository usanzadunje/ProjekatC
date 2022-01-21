<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class RegularPlaceController extends Controller
{
    public function index(): InertiaResponse {
        $places = Place::select(['id', 'name', 'address', 'city'])->simplePaginate(12);

        return Inertia::render('Places/Regular/Index', compact('places'));
    }


    public function show(Place $place): InertiaResponse {
        return Inertia::render('Places/Regular/Show', compact('place'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class RegularPlaceController extends Controller
{
    public function index(): InertiaResponse {
        $filter = request('filter') ?? '';

        $places = Place::select(['id', 'name', 'address', 'city'])
            ->filter($filter, ['name', 'address', 'city'])
            ->simplePaginate(12);

        return Inertia::render('Places/Regular/Index', compact('places'));
    }


    public function show(Place $place): InertiaResponse {
        $place = $place->only('id', 'name', 'address', 'city');

        return Inertia::render('Places/Regular/Show', compact('place'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Inertia\Inertia;

class RegularPlaceController extends Controller
{
    public function index() {
        $places = Place::all();

        return Inertia::render('Places/Regular/Index', compact('places'));
    }


    public function show(Place $place) {
        //
    }
}

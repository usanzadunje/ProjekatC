<?php

use App\Http\Controllers\RegularPlaceController;
use App\Http\Controllers\RegularReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::inertia('/dashboard', 'Dashboard/Regular')->name('dashboard');

// Place based routes
Route::controller(RegularPlaceController::class)
    ->prefix('place')
    ->as('place.')
    ->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/{place}', 'show')->name('show');
    });

// Reservation based routes
Route::controller(RegularReservationController::class)
    ->as('reservation.')
    ->group(function() {
        Route::get('/reservation/create/{place}', 'create')->name('create');
        Route::get('/reservation/{reservation}/edit/{place}', 'edit')->name('edit');
    });
Route::resource('reservation', RegularReservationController::class)
    ->except('create', 'edit');

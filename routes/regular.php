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
        Route::get('/place/{place}/reservation/create', 'create')->name('create');
        Route::get('/place/{place}/reservation/{reservation}/edit', 'edit')->name('edit');
    });
Route::resource('reservation', RegularReservationController::class)
    ->except('create', 'edit');

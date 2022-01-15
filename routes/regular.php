<?php

use App\Http\Controllers\RegularReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::inertia('/', 'Dashboard/Regular')->name('dashboard');

Route::resource('reservation', RegularReservationController::class);

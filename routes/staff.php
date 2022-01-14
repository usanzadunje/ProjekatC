<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::inertia('/', 'Dashboard/Staff')->name('dashboard');

Route::resource('reservation', ReservationController::class);

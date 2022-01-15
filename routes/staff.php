<?php

use App\Http\Controllers\StaffReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::inertia('/', 'Dashboard/Staff')->name('dashboard');

Route::resource('reservation', StaffReservationController::class);

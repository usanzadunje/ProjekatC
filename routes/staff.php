<?php

use App\Http\Controllers\StaffReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::inertia('/dashboard', 'Dashboard/Staff')->name('dashboard');

Route::resource('reservation', StaffReservationController::class)
    ->except('create', 'store');

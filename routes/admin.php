<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::inertia('/dashboard', 'Dashboard/Admin')->name('dashboard');

Route::resource('client', ClientController::class);


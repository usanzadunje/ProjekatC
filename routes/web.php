<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::inertia('/test', 'Welcome')->name('welcome');
Route::get('/home', HomeController::class)
    ->middleware('auth')
    ->name('home');





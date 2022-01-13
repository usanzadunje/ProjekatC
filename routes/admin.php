<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::inertia('/', 'Dashboard/Admin')->name('dashboard');
Route::get('/test', function() {
    dd('works');
})->name('test');

Route::get('/clients', [ClientController::class, 'index'])->name('client.index');
Route::get('/clients/create', [ClientController::class, 'create'])->name('client.create');
Route::post('/clients', [ClientController::class, 'store'])->name('client.store');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('client.destroy');


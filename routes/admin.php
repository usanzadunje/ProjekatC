<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::inertia('/', 'Welcome')->name('welcome');
Route::get('/home', [HomeController::class])
    ->middleware('auth')
    ->name('home');

/**
 * Authenticated routes
 */
Route::middleware('auth')->group(function(){

});
Route::name('admin')->prefix('admin')->middleware(['auth'])->group(function() {
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::inertia('/', 'Dashboard/Admin')->middleware('admin')->name('dashboard.admin');
});




<?php

use App\Http\Controllers\JobSeeker\CreateController;
use App\Http\Controllers\JobSeeker\StoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', CreateController::class)
    ->name('job-seekers.create');

Route::post('job-seekers', StoreController::class)
    ->name('job-seekers.store');

Route::get('with/{slug}', CreateController::class)
    ->name('job-seekers.match');

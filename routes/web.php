<?php

use App\Http\Controllers\JobSeeker\Create;
use App\Http\Controllers\JobSeeker\Store;
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

Route::get('/', Create::class)
    ->name('job-seekers.create');

Route::post('job-seekers', Store::class)
    ->name('job-seekers.store');

Route::get('with/{slug}', Create::class)
    ->name('job-seekers.match');

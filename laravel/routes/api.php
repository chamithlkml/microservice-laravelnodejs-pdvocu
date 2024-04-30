<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/register', [UserAuthController::class, 'register']);

Route::get('auth/user', [UserAuthController::class, 'index'])
    ->middleware('auth:sanctum');

Route::resource('reservations', ReservationController::class)
    ->except(['create', 'edit', 'destroy'])
    ->middleware('auth:sanctum');
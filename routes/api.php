<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SmMotelesController;
use App\Http\Controllers\SmUsuarioController;
use App\Http\Controllers\SmHabitacionesController;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['cors','api'])->group(function(){
    Route::controller(SmUsuarioController::class)->group(function(){
        Route::post('/login',  'login');
    });
    Route::controller(SmMotelesController::class)->group(function(){
        Route::get('/moteles/lista',  'allMotels');
    });

    Route::controller(SmHabitacionesController::class)->group(function(){
        Route::get('/habitaciones/{id}','allHabitacionesByMotel');
    });
    Route::controller(ReservationController::class)->group(function(){
        Route::get('/reservaciones/{id}','getReservationsByUser');
        Route::post('/reservar','store');
    });
});
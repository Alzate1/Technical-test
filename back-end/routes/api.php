<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UbicationController;
use App\Http\Controllers\CurrencyController;

// Ruta protegida que devuelve el usuario autenticado
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Ruta para registrar un nuevo usuario
Route::post('/register', [UserController::class, 'register']);

// Ruta para obtener todos los países
Route::get('/contries', [UbicationController::class, 'allcountries']);

// Ruta para obtener las ciudades de un país específico
Route::get('/cities/{countryId}', [UbicationController::class, 'getCitiesByCountry']);

// Ruta para registrar el historial de transacciones
Route::post('/history', [CurrencyController::class, 'history']);

// Ruta para obtener los últimos 5 registros del historial
Route::get('/getHistory', [CurrencyController::class, 'getHistory']);



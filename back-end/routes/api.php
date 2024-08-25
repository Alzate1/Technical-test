<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UbicationController;
use App\Http\Controllers\CurrencyController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logOut']);
Route::get('/contries', [UbicationController::class, 'allcountries']);
Route::get('/cities', [UbicationController::class, 'allcities']);
Route::post('/history', [CurrencyController::class, 'history']);

Route::get('/getHistory', [CurrencyController::class, 'getHistory']);




// Route::middleware('auth')->post('/history', [CurrencyController::class, 'history']);


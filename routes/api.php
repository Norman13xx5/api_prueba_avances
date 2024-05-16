<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::get('dataSesion', 'getAllDataSesion');
});

Route::controller(UserController::class)->group(function () {
    Route::post('users', 'store');
    Route::get('users', 'index');
    Route::delete('user/{id}', 'destroy');
});

Route::controller(HistoriesController::class)->group(function () {
    Route::get('histories',  'store');
    Route::get('histories/{id}', 'index');
    Route::get('history/{id}', 'show');
    Route::put('history/{id}', 'update');
    Route::delete('history/{id}', 'destroy');
});

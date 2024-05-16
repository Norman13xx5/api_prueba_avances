<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('register', [AuthController::class, 'register']);
    // Route::post('me', [AuthController::class, 'me']);

    Route::get('user/{id}', [UserController::class, 'show']);
    Route::put('user/{id}', [UserController::class, 'update']);
    // Route::delete('user', [UserController::class, 'delete']);

    Route::post('histories', [HistoriesController::class, 'store']);
    Route::get('histories/{id}', [HistoriesController::class, 'index']);
    Route::get('history/{id}', [HistoriesController::class, 'show']);
    Route::put('history/{id}', [HistoriesController::class, 'update']);
    Route::delete('history/{id}', [HistoriesController::class, 'destroy']);
});

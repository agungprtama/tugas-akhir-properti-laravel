<?php

use App\Http\Controllers\API\ArtikelController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PropertyController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'fetch']);
    Route::post('user', [AuthController::class, 'updateProfile']);
    Route::post('user/photo', [AuthController::class, 'updatePhoto']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('properties', PropertyController::class);
    Route::post('properties/update/{id}', [PropertyController::class, 'updateWithPost']);

    Route::get('user/properties', [PropertyController::class, 'userProperties']);

});

Route::get('artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{id}', [ArtikelController::class, 'show']);


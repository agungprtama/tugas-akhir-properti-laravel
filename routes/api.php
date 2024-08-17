<?php

use App\Http\Controllers\API\ArtikelController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CodeCheckController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\ImagePropertyController;
use App\Http\Controllers\API\InquiryController;
use App\Http\Controllers\API\KprSimulateController;
use App\Http\Controllers\API\PropertyController;
use App\Http\Controllers\API\ResetPasswordController;
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

    Route::post('properties/update/{id}', [PropertyController::class, 'updateWithPost']);

    // Route::apiResource('properties', PropertyController::class);

    Route::post('properties', [PropertyController::class, 'store']);
    Route::put('properties/{property}', [PropertyController::class, 'updateWithPost']);
    Route::patch('properties/{property}', [PropertyController::class, 'updateWithPost']);
    Route::delete('properties/{property}', [PropertyController::class, 'destroy']);

    Route::get('user/properties', [PropertyController::class, 'userProperties']);
});

Route::get('properties/{property}', [PropertyController::class, 'show']);

Route::get('properties', [PropertyController::class, 'index']);
Route::get('property-show-user', [PropertyController::class, 'showUser']);

Route::get('artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{id}', [ArtikelController::class, 'show']);

Route::post('simulate', [KprSimulateController::class, 'simulate']);

Route::post('/properties/images/upload', [ImagePropertyController::class, 'uploadImages']);


Route::post('password/email',  [ForgotPasswordController::class, 'index']);
Route::post('password/code/check', [CodeCheckController::class]);
Route::post('password/reset', [ResetPasswordController::class, 'index']);
Route::post('inquiries', [InquiryController::class, 'store']);

<?php

use App\Http\Controllers\API\ArtikelController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CategoryMarketplaceController;
use App\Http\Controllers\API\CodeCheckController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\HistoryTransactionController;
use App\Http\Controllers\API\ImagePropertyController;
use App\Http\Controllers\API\InquiryController;
use App\Http\Controllers\API\KprSimulateController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\PropertyController;
use App\Http\Controllers\API\ResetPasswordController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\TransactionMarketplaceController;
use App\Http\Controllers\API\VenueController;
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

Route::middleware(['auth:sanctum', 'response.formatter'])->group(function () {
    Route::get('user', [AuthController::class, 'fetch']);
    Route::post('user', [AuthController::class, 'updateProfile']);
    Route::post('user/photo', [AuthController::class, 'updatePhoto']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('transactions', [TransactionController::class, 'store']);

    Route::get('history-transactions', [HistoryTransactionController::class, 'index']);
    Route::get('history-transactions/{id}', [HistoryTransactionController::class, 'show']);

    Route::post('bookings', [BookingController::class, 'store']);
    Route::get('bookings', [BookingController::class, 'index']);
    Route::get('bookings/{id}', [BookingController::class, 'show']);
    Route::put('bookings/{id}', [BookingController::class, 'update']);
    Route::delete('bookings/{id}', [BookingController::class, 'destroy']);

    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{id}', [ProductController::class, 'show']);
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);

    Route::get('category-marketplaces', [CategoryMarketplaceController::class, 'index']);
    Route::get('category-marketplaces/{id}', [CategoryMarketplaceController::class, 'show']);
    Route::post('category-marketplaces', [CategoryMarketplaceController::class, 'store']);
    Route::put('category-marketplaces/{id}', [CategoryMarketplaceController::class, 'update']);
    Route::delete('category-marketplaces/{id}', [CategoryMarketplaceController::class, 'destroy']);

    Route::get('transaction-marketplaces', [TransactionMarketplaceController::class, 'index']);
    Route::get('transaction-marketplaces/{id}', [TransactionMarketplaceController::class, 'show']);
    Route::post('transaction-marketplaces', [TransactionMarketplaceController::class, 'store']);
    Route::put('transaction-marketplaces/{id}', [TransactionMarketplaceController::class, 'update']);
    Route::delete('transaction-marketplaces/{id}', [TransactionMarketplaceController::class, 'destroy']);
});

Route::get('venues', [VenueController::class, 'index']);
Route::post('venues', [VenueController::class, 'store']);
Route::get('venues/{id}', [VenueController::class, 'show']);
Route::put('venues/{id}', [VenueController::class, 'update']);
Route::delete('venues/{id}', [VenueController::class, 'destroy']);
Route::get('venues/category/{category_id}', [VenueController::class, 'showbyCategoryId']);

Route::post('categories', [CategoryController::class, 'store']);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{id}', [CategoryController::class, 'show']);
Route::put('categories/{id}', [CategoryController::class, 'update']);
Route::delete('categories/{id}', [CategoryController::class, 'destroy']);

Route::post('banners', [BannerController::class, 'store']);
Route::get('banners', [BannerController::class, 'index']);
Route::get('banners/{id}', [BannerController::class, 'show']);
Route::put('banners/{id}', [BannerController::class, 'update']);
Route::delete('banners/{id}', [BannerController::class, 'destroy']);

Route::post('notifications', [NotificationController::class, 'store']);
Route::get('notifications', [NotificationController::class, 'index']);
Route::get('notifications/{id}', [NotificationController::class, 'show']);
Route::put('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
Route::delete('notifications/{id}', [NotificationController::class, 'destroy']);

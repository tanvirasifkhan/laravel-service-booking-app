<?php

use App\Http\Controllers\Customer\CustomerReadAllBookingsController;
use App\Http\Middleware\CustomerMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\RegisterCustomerController;
use App\Http\Controllers\Customer\CustomerLoginController;
use App\Http\Controllers\Customer\CustomerLogoutController;
use App\Http\Controllers\Customer\CustomerCreateBookingController;

Route::post('register', RegisterCustomerController::class);
Route::post('login', CustomerLoginController::class);
Route::post('logout', CustomerLogoutController::class)->middleware('auth:sanctum');
Route::get('bookings', CustomerReadAllBookingsController::class)->middleware(['auth:sanctum', CustomerMiddleware::class]);
Route::post('bookings', CustomerCreateBookingController::class)->middleware(['auth:sanctum', CustomerMiddleware::class]);

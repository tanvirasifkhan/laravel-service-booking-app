<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\AdminLogoutController;
use App\Http\Controllers\Admin\AdminReadAllBookingsController;

Route::post('login', AdminAuthenticationController::class);
Route::post('logout', AdminLogoutController::class)->middleware('auth:sanctum');
Route::get('bookings', AdminReadAllBookingsController::class)->middleware(['auth:sanctum', AdminMiddleware::class]);
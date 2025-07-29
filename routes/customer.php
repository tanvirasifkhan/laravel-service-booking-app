<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\RegisterCustomerController;
use App\Http\Controllers\Customer\CustomerLoginController;
use App\Http\Controllers\Customer\CustomerLogoutController;

Route::post('register', RegisterCustomerController::class);
Route::post('login', CustomerLoginController::class);
Route::post('logout', CustomerLogoutController::class)->middleware('auth:sanctum');
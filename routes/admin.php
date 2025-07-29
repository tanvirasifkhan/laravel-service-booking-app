<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\AdminLogoutController;

Route::post('login', AdminAuthenticationController::class);
Route::post('logout', AdminLogoutController::class)->middleware('auth:sanctum');
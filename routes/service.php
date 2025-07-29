<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Service\ReadAllServiceController;
use App\Http\Controllers\Service\StoreServiceController;

Route::get("", ReadAllServiceController::class)->middleware(['auth:sanctum']);
Route::post("", StoreServiceController::class)->middleware(['auth:sanctum', AdminMiddleware::class]);
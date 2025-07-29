<?php

use App\Http\Controllers\Service\UpdateServiceController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Service\ReadAllServiceController;
use App\Http\Controllers\Service\StoreServiceController;
use App\Http\Controllers\Service\DeleteServiceController;

Route::get("", ReadAllServiceController::class)->middleware(['auth:sanctum']);
Route::post("", StoreServiceController::class)->middleware(['auth:sanctum', AdminMiddleware::class]);
Route::put("{id}", UpdateServiceController::class)->middleware(['auth:sanctum', AdminMiddleware::class]);
Route::delete("{id}", DeleteServiceController::class)->middleware(['auth:sanctum', AdminMiddleware::class]);
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Service\ReadAllServiceController;

Route::get("", ReadAllServiceController::class)->middleware(['auth:sanctum']);
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminAuthenticationController;

Route::post('login', AdminAuthenticationController::class);
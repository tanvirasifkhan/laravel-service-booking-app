<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\RegisterCustomerController;

Route::post('register', RegisterCustomerController::class);
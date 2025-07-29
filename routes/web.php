<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'API server for Service Booking System',
        'statusCode' => 200,
        'Language'  => 'PHP ' . phpversion(),
        'Framework' => 'Laravel ' . app()->version()
    ]);
});

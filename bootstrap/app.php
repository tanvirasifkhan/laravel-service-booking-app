<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CustomerMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function(){
            Route::prefix('api/admins')
                ->middleware('api')
                ->group(base_path('routes/admin.php'));
            Route::prefix('api/customers')
                ->middleware('api')
                ->group(base_path('routes/customer.php'));
            Route::prefix('api/services')
                ->middleware('api')
                ->group(base_path('routes/service.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

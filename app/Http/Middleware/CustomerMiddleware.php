<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Customer;
use App\Traits\ApiResponse;

class CustomerMiddleware
{
    use ApiResponse;


    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if($user && $user instanceof Customer) {
            return $next($request);
        }else{
            return $this->errorResponse(
                errorMessage: 'Unauthorized access! Customer privileges are required.',
                statusCode: 403,
                data: null
            );
        }
    }
}

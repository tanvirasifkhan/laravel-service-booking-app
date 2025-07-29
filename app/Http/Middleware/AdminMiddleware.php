<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Traits\ApiResponse;

class AdminMiddleware
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

        if($user && $user instanceof User) {
            return $next($request);
        }else{
            return $this->errorResponse(
                errorMessage: 'Unauthorized access! Admin privileges are required.',
                statusCode: 403,
                data: null
            );
        }
    }
}

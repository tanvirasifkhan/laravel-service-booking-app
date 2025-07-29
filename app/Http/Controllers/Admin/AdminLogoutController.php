<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\AdminAuthenticationRepository;

class AdminLogoutController extends Controller
{
    use ApiResponse;

    private $adminAuthenticationRepository;

    public function __construct(AdminAuthenticationRepository $adminAuthenticationRepository)
    {
        $this->adminAuthenticationRepository = $adminAuthenticationRepository;
    }


    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->adminAuthenticationRepository->logout($request);

        return $this->successResponse(
            successMessage: 'Successfully logged out.',
            statusCode: 200,
            data: null, 
        );
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminAuthenticationRequest;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Repositories\AdminAuthenticationRepository;
use Illuminate\Support\Facades\Hash;


class AdminAuthenticationController extends Controller
{
    use ApiResponse;

    private $adminAuthenticationRepository;

    public function __construct(AdminAuthenticationRepository $adminAuthenticationRepository)
    {
        $this->adminAuthenticationRepository = $adminAuthenticationRepository;
    }

    /**
     * Handle the incoming request.
     * 
     * @return JsonResponse
     */
    public function __invoke(AdminAuthenticationRequest $adminAuthenticationRequest): JsonResponse
    {
        $credentials = $adminAuthenticationRequest->validated();

        $admin = $this->adminAuthenticationRepository->authenticate($credentials);

        if($admin && Hash::check($credentials["password"], $admin->password)) { 
            $admin->token = $admin->createToken('admin-token')->plainTextToken;

            return $this->successResponse(
                successMessage: 'Authenticated successfully.',
                statusCode: 200,
                data: new UserResource($admin)
            );
        }else {
            return $this->errorResponse(
                errorMessage: 'Invalid credentials! Authentication failed.',
                statusCode: 401,
                data: null
            );
        }       
    }
}
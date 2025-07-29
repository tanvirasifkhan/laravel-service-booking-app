<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminAuthenticationRequest;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Repositories\AdminAuthenticationRepository;


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

        if($this->adminAuthenticationRepository->authenticate($credentials)) {
            $user = $adminAuthenticationRequest->user();

            $user->token = $user->createToken('admin-token')->plainTextToken;

            return $this->successResponse(
                successMessage: 'Authenticated successfully.',
                statusCode: 200,
                data: new UserResource($user)
            );
        }else{
            return $this->errorResponse(
                errorMessage: 'Invalid credentials! Authentication failed.',
                statusCode: 401,
                data: null
            );
        }
    }
}
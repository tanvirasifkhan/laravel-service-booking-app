<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\CustomerAuthenticationRepository;

class CustomerLogoutController extends Controller
{

    use ApiResponse;

    private $customerAuthenticationRepository;

    public function __construct(CustomerAuthenticationRepository $customerAuthenticationRepository)
    {
        $this->customerAuthenticationRepository = $customerAuthenticationRepository;
    }


    /**
     * Handle the incoming request.
     * 
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->customerAuthenticationRepository->logout($request);

        return $this->successResponse(
            successMessage: 'Customer logged out successfully.',
            statusCode: 200,
            data: null
        );
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\RegisterCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\CustomerAuthenticationRepository;

class RegisterCustomerController extends Controller
{
    use ApiResponse;

    private $customerAuthenticationRepository;

    public function __construct(CustomerAuthenticationRepository $customerAuthenticationRepository)
    {
        $this->customerAuthenticationRepository = $customerAuthenticationRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterCustomerRequest $registerCustomerRequest): JsonResponse
    {
        $credentials = $registerCustomerRequest->validated();

        $credentials['password'] = bcrypt($credentials['password']);

        $customer = $this->customerAuthenticationRepository->register($credentials);

        if($customer != NULL) {
            $customer->token = $customer->createToken('customer-token')->plainTextToken;;

            return $this->successResponse(
                successMessage:'Customer registered successfully.',
                statusCode:201,
                data: new CustomerResource($customer)
            );
        }else{
            return $this->errorResponse(
                errorMessage:'Customer registration failed.',
                statusCode:400,
                data: null
            );
        }
    }
}

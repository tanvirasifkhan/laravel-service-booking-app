<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomeLoginRequest;
use App\Http\Resources\CustomerResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\CustomerAuthenticationRepository;
use Illuminate\Support\Facades\Hash;


class CustomerLoginController extends Controller
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
    public function __invoke(CustomeLoginRequest $customeLoginRequest): JsonResponse
    {
        $credentials = $customeLoginRequest->validated();

        $customer = $this->customerAuthenticationRepository->authenticate($credentials);

        if($customer && Hash::check($credentials["password"], $customer->password)) { 
            $customer->token = $customer->createToken('customer-token')->plainTextToken;

            return $this->successResponse(
                successMessage: 'Authenticated successfully.',
                statusCode: 200,
                data: new CustomerResource($customer)
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

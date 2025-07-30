<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Repositories\CustomerBookingRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CustomerReadAllBookingsController extends Controller
{
    use ApiResponse;

    private $customerBookingRepository;

    public function __construct(CustomerBookingRepository $customerBookingRepository)
    {
        $this->customerBookingRepository = $customerBookingRepository;
    }
    
    /**
     * Handle the incoming request.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $bookings = $this->customerBookingRepository->all()->paginate(10);

        return $this->successResponse(            
            successMessage: 'Bookings fetched successfully.',
            statusCode: 200,
            data: BookingResource::collection($bookings)->response()->getData(true)
        );
    }
}

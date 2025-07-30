<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateBookingRequest;
use App\Http\Resources\BookingResource;
use App\Repositories\CustomerBookingRepository;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerCreateBookingController extends Controller
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
    public function __invoke(CreateBookingRequest $bookingRequest): \Illuminate\Http\JsonResponse
    {
        $bookingData = $bookingRequest->validated();

        $bookingData['customer_id'] = auth()->id();

        $bookingDate = Carbon::parse($bookingData['date'])->format('Y-m-d');
        
        if($bookingDate < Carbon::today()->format('Y-m-d')) {
            return $this->errorResponse(
                errorMessage: 'Booking date cannot be in the past.',
                statusCode: 422,
                data: null
            );
        }

        $booking = $this->customerBookingRepository->create($bookingData);

        return $this->successResponse(
            successMessage: 'Booking created successfully.',
            statusCode: 201,
            data: new BookingResource($booking)
        );
    }
}

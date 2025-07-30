<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Repositories\AdminBookingRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AdminReadAllBookingsController extends Controller
{
    use ApiResponse;

    private $adminBookingRepository;

    public function __construct(AdminBookingRepository $adminBookingRepository)
    {
        $this->adminBookingRepository = $adminBookingRepository;
    }
    
    /**
     * Handle the incoming request.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $bookings = $this->adminBookingRepository->all()->paginate(10);

        return $this->successResponse(            
            successMessage: 'Bookings fetched successfully.',
            statusCode: 200,
            data: BookingResource::collection($bookings)->response()->getData(true),
        );
    }
}

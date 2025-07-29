<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Repositories\ServiceRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;

class ReadAllServiceController extends Controller
{
    use ApiResponse;

    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $services = $this->serviceRepository->all()->paginate(10);

        return $this->successResponse(
            successMessage: 'Services fetched successfully.',
            statusCode: 200,
            data: ServiceResource::collection($services)->response()->getData(true)
        );
    }
}

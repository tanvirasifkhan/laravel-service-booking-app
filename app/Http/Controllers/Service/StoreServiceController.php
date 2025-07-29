<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\CreateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Repositories\ServiceRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreServiceController extends Controller
{
    use ApiResponse;

    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }
    
    /**
     * Handle the incoming request.
     * 
     * @return JsonResponse
     */
    public function __invoke(CreateServiceRequest $createServiceRequest): JsonResponse
    {
        $serviceData = $createServiceRequest->validated();

        $service = $this->serviceRepository->create($serviceData);

        return $this->successResponse(
            successMessage: 'Service created successfully.',
            statusCode: 201,
            data: new ServiceResource($service)
        );
    }
}

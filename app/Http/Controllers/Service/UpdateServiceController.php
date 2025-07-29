<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Repositories\ServiceRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateServiceController extends Controller
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
    public function __invoke(UpdateServiceRequest $updateServiceRequest, int $id): JsonResponse
    {
        $findService = $this->serviceRepository->fetch($id);

        if($findService == NULL) {
            return $this->errorResponse(
                errorMessage: "Service resource not found.",
                statusCode: 404,
                data: null
            );
        }

        $this->serviceRepository->update($id, $updateServiceRequest->validated());

        $service = $this->serviceRepository->fetch($id);

        return $this->successResponse(
            successMessage: "Service resource updated successfully.",
            statusCode: 200,
            data: new ServiceResource($service)
        );
    }
}

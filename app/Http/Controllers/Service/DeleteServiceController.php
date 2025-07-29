<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Repositories\ServiceRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteServiceController extends Controller
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
    public function __invoke(Request $request, int $id): JsonResponse
    {
        $service = $this->serviceRepository->fetch($id);

        if($service == NULL) {
            return $this->errorResponse(
                errorMessage: "Service resource not found.",
                statusCode: 404,
                data: null
            );
        }

        $this->serviceRepository->delete($id);

        return $this->successResponse(
            successMessage: "Service resource deleted successfully.",
            statusCode: 200,
            data: null
        );
    }
}

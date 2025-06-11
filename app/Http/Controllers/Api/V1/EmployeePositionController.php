<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\EmployeePosition;
use App\Services\EmployeePositionService;
use App\Http\Requests\Api\V1\StoreEmployeePositionRequest;
use App\Http\Requests\Api\V1\UpdateEmployeePositionRequest;
use App\Http\Resources\Api\V1\EmployeePositionResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class EmployeePositionController extends Controller
{
    public function __construct(
        protected EmployeePositionService $employeePositionService,
    ) {}

    public function index(): ResourceCollection
    {
        $employeePositions = $this->employeePositionService->list();
        return EmployeePositionResource::collection($employeePositions);
    }

    public function store(StoreEmployeePositionRequest $request): EmployeePositionResource
    {
        $employeePosition = $this->employeePositionService->create($request->validated());
        return new EmployeePositionResource($employeePosition);
    }

    public function show(int $id): EmployeePositionResource
    {
        $employeePosition = $this->employeePositionService->find($id);
        return new EmployeePositionResource($employeePosition);
    }

    public function update(UpdateEmployeePositionRequest $request, int $id): EmployeePositionResource
    {
        $employeePosition = $this->employeePositionService->find($id);
        $employeePosition->update($request->validated());
        return new EmployeePositionResource($employeePosition);
    }

    public function destroy(int $id): JsonResponse
    {
        $employeePosition = $this->employeePositionService->find($id);
        $employeePosition->delete();
        return response()->json(['message' => 'Employee position deleted successfully']);
    }
}
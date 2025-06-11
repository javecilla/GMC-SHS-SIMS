<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ScheduleCategory;
use App\Services\ScheduleCategoryService;
use App\Http\Requests\Api\V1\StoreScheduleCategoryRequest;
use App\Http\Requests\Api\V1\UpdateScheduleCategoryRequest;
use App\Http\Resources\Api\V1\ScheduleCategoryResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class ScheduleCategoryController extends Controller
{
    public function __construct(
        protected ScheduleCategoryService $scheduleCategoryService,
    ) {}

    public function index(): ResourceCollection
    {
        $scheduleCategories = $this->scheduleCategoryService->list();
        return ScheduleCategoryResource::collection($scheduleCategories);
    }

    public function store(StoreScheduleCategoryRequest $request): ScheduleCategoryResource
    {
        $scheduleCategory = $this->scheduleCategoryService->create($request->validated());
        return new ScheduleCategoryResource($scheduleCategory);
    }

    public function show(int $id): ScheduleCategoryResource
    {
        $scheduleCategory = $this->scheduleCategoryService->find($id);
        return new ScheduleCategoryResource($scheduleCategory);
    }

    public function update(UpdateScheduleCategoryRequest $request, int $id): ScheduleCategoryResource
    {
        $scheduleCategory = $this->scheduleCategoryService->find($id);
        $scheduleCategory->update($request->validated());
        return new ScheduleCategoryResource($scheduleCategory);
    }

    public function destroy(int $id): JsonResponse
    {
        $scheduleCategory = $this->scheduleCategoryService->find($id);
        $scheduleCategory->delete();
        return response()->json(['message' => 'Schedule category deleted successfully']);
    }
}
<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\YearLevel;
use App\Services\YearLevelService;
use App\Http\Requests\Api\V1\StoreYearLevelRequest;
use App\Http\Requests\Api\V1\UpdateYearLevelRequest;
use App\Http\Resources\Api\V1\YearLevelResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class YearLevelController extends Controller
{
    public function __construct(
        protected YearLevelService $yearLevelService,
    ) {}

    public function index(): ResourceCollection
    {
        $yearLevels = $this->yearLevelService->list();
        return YearLevelResource::collection($yearLevels);
    }

    public function store(StoreYearLevelRequest $request): YearLevelResource
    {
        $yearLevel = $this->yearLevelService->create($request->validated());
        return new YearLevelResource($yearLevel);
    }

    public function show(int $id): YearLevelResource
    {
        $yearLevel = $this->yearLevelService->find($id);
        return new YearLevelResource($yearLevel);
    }

    public function update(UpdateYearLevelRequest $request, int $id): YearLevelResource
    {
        $yearLevel = $this->yearLevelService->find($id);
        $yearLevel->update($request->validated());
        return new YearLevelResource($yearLevel);
    }

    public function destroy(int $id): JsonResponse
    {
        $yearLevel = $this->yearLevelService->find($id);
        $yearLevel->delete();
        return response()->json(['message' => 'Year Level deleted successfully']);
    }
}

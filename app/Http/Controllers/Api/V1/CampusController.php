<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Campus;
use App\Services\CampusService;
use App\Http\Requests\Api\V1\StoreCampusRequest;
use App\Http\Requests\Api\V1\UpdateCampusRequest;
use App\Http\Resources\Api\V1\CampusResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class CampusController extends Controller
{
    public function __construct(
        protected CampusService $campusService
    ) {}

    public function index(): ResourceCollection
    {
        $campuses = $this->campusService->list();
        return CampusResource::collection($campuses);
    }

    public function store(StoreCampusRequest $request): CampusResource
    {
        $campus = $this->campusService->create($request->validated());
        return new CampusResource($campus);
    }

    public function show(int $id): CampusResource
    {
        $campus = $this->campusService->find($id);
        return new CampusResource($campus);
    }

    public function update(UpdateCampusRequest $request, int $id): CampusResource
    {
        $campus = $this->campusService->find($id);
        $updated = $this->campusService->update($campus, $request->validated());
        return new CampusResource($updated);
    }

    public function destroy(int $id): JsonResponse
    {
        $campus = $this->campusService->find($id);
        $this->campusService->delete($campus);
        return response()->json(['message' => 'Campus deleted successfully.'], 200);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\SchoolYear;
use App\Services\SchoolYearService;
use App\Http\Requests\Api\V1\StoreSchoolYearRequest;
use App\Http\Requests\Api\V1\UpdateSchoolYearRequest;
use App\Http\Resources\Api\V1\SchoolYearResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class SchoolYearController extends Controller
{
    public function __construct(
        protected SchoolYearService $schoolYearService,
    ) {}

    public function index(): ResourceCollection
    {
        $schoolYears = $this->schoolYearService->list();
        return SchoolYearResource::collection($schoolYears);
    }

    public function store(StoreSchoolYearRequest $request): SchoolYearResource
    {
        $schoolYear = $this->schoolYearService->create($request->validated());
        return new SchoolYearResource($schoolYear);
    }

    public function show(int $id): SchoolYearResource
    {
        $schoolYear = $this->schoolYearService->find($id);
        return new SchoolYearResource($schoolYear);
    }

    public function current(): SchoolYearResource
    {
        $schoolYear = $this->schoolYearService->current();
        return new SchoolYearResource($schoolYear);
    }

    public function update(UpdateSchoolYearRequest $request, int $id): SchoolYearResource
    {
        $schoolYear = $this->schoolYearService->find($id);
        $schoolYear = $this->schoolYearService->update($schoolYear, $request->validated());
        return new SchoolYearResource($schoolYear);
    }

    public function destroy(int $id): JsonResponse
    {
        $schoolYear = $this->schoolYearService->find($id);
        $this->schoolYearService->delete($schoolYear);
        return response()->json(['message' => 'School year deleted successfully']);
    }
}

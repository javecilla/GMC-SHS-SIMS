<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Semester;
use App\Services\SemesterService;
use App\Http\Requests\Api\V1\StoreSemesterRequest;
use App\Http\Requests\Api\V1\UpdateSemesterRequest;
use App\Http\Resources\Api\V1\SemesterResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class SemesterController extends Controller
{
    public function __construct(
        protected SemesterService $semesterService,
    ) {}

    public function index(): ResourceCollection
    {
        $semesters = $this->semesterService->list();
        return SemesterResource::collection($semesters);
    }

    public function store(StoreSemesterRequest $request): SemesterResource
    {
        $semester = $this->semesterService->create($request->validated());
        return new SemesterResource($semester);
    }

    public function show(int $id): SemesterResource
    {
        $semester = $this->semesterService->find($id);
        return new SemesterResource($semester);
    }

    public function update(UpdateSemesterRequest $request, int $id): SemesterResource
    {
        $semester = $this->semesterService->find($id);
        $semester->update($request->validated());
        return new SemesterResource($semester);
    }

    public function destroy(int $id): JsonResponse
    {
        $semester = $this->semesterService->find($id);
        $semester->delete();
        return response()->json(['message' => 'Semester deleted successfully']);
    }
}

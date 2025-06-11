<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Subject;
use App\Services\SubjectService;
use App\Http\Requests\Api\V1\StoreSubjectRequest;
use App\Http\Requests\Api\V1\UpdateSubjectRequest;
use App\Http\Resources\Api\V1\SubjectResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class SubjectController extends Controller
{
    public function __construct(
        protected SubjectService $subjectService,
    ) {}

    public function index(): ResourceCollection
    {
        $subjects = $this->subjectService->list();
        return SubjectResource::collection($subjects);
    }

    public function store(StoreSubjectRequest $request): SubjectResource
    {
        $subject = $this->subjectService->create($request->validated());
        return new SubjectResource($subject);
    }

    public function show(int $id): SubjectResource
    {
        $subject = $this->subjectService->find($id);
        return new SubjectResource($subject);
    }

    public function update(UpdateSubjectRequest $request, int $id): SubjectResource
    {
        $subject = $this->subjectService->find($id);
        $subject->update($request->validated());
        return new SubjectResource($subject);
    }

    public function destroy(int $id): JsonResponse
    {
        $subject = $this->subjectService->find($id);
        $subject->delete();
        return response()->json(['message' => 'Subject deleted successfully']);
    }
}

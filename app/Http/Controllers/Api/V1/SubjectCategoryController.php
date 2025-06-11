<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\SubjectCategory;
use App\Services\SubjectCategoryService;
use App\Http\Requests\Api\V1\StoreSubjectCategoryRequest;
use App\Http\Requests\Api\V1\UpdateSubjectCategoryRequest;
use App\Http\Resources\Api\V1\SubjectCategoryResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class SubjectCategoryController extends Controller
{
    public function __construct(
        protected SubjectCategoryService $subjectCategoryService,
    ) {}

    public function index(): ResourceCollection
    {
        $subjectCategories = $this->subjectCategoryService->list();
        return SubjectCategoryResource::collection($subjectCategories);
    }

    public function store(StoreSubjectCategoryRequest $request): SubjectCategoryResource
    {
        $subjectCategory = $this->subjectCategoryService->create($request->validated());
        return new SubjectCategoryResource($subjectCategory);
    }

    public function show(int $id): SubjectCategoryResource
    {
        $subjectCategory = $this->subjectCategoryService->find($id);
        return new SubjectCategoryResource($subjectCategory);
    }

    public function update(UpdateSubjectCategoryRequest $request, int $id): SubjectCategoryResource
    {
        $subjectCategory = $this->subjectCategoryService->find($id);
        $subjectCategory->update($request->validated());
        return new SubjectCategoryResource($subjectCategory);
    }

    public function destroy(int $id): JsonResponse
    {
        $subjectCategory = $this->subjectCategoryService->find($id);
        $subjectCategory->delete();
        return response()->json(['message' => 'Subject category deleted successfully']);
    }
}

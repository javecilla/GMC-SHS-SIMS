<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Section;
use App\Services\SectionService;
use App\Http\Requests\Api\V1\StoreSectionRequest;
use App\Http\Requests\Api\V1\UpdateSectionRequest;
use App\Http\Resources\Api\V1\SectionResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class SectionController extends Controller
{
    public function __construct(
        protected SectionService $sectionService,
    ) {}

    public function index(): ResourceCollection
    {
        $sections = $this->sectionService->list();
        return SectionResource::collection($sections);
    }

    public function store(StoreSectionRequest $request): SectionResource
    {
        $section = $this->sectionService->create($request->validated());
        return new SectionResource($section);
    }

    public function show(int $id): SectionResource
    {
        $section = $this->sectionService->find($id);
        return new SectionResource($section);
    }

    public function update(UpdateSectionRequest $request, int $id): SectionResource
    {
        $section = $this->sectionService->find($id);
        $section->update($request->validated());
        return new SectionResource($section);
    }

    public function destroy(int $id): JsonResponse
    {
        $section = $this->sectionService->find($id);
        $section->delete();
        return response()->json(['message' => 'Section deleted successfully']);
    }
}

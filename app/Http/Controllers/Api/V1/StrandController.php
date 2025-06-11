<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Strand;
use App\Services\StrandService;
use App\Http\Requests\Api\V1\StoreStrandRequest;
use App\Http\Requests\Api\V1\UpdateStrandRequest;
use App\Http\Resources\Api\V1\StrandResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class StrandController extends Controller
{
    public function __construct(
        protected StrandService $strandService,
    ) {}

    public function index(): ResourceCollection
    {
        $strands = $this->strandService->list();
        return StrandResource::collection($strands);
    }

    public function store(StoreStrandRequest $request): StrandResource
    {
        $strand = $this->strandService->create($request->validated());
        return new StrandResource($strand);
    }

    public function show(int $id): StrandResource
    {
        $strand = $this->strandService->find($id);
        return new StrandResource($strand);
    }

    public function update(UpdateStrandRequest $request, int $id): StrandResource
    {
        $strand = $this->strandService->find($id);
        $strand->update($request->validated());
        return new StrandResource($strand);
    }

    public function destroy(int $id): JsonResponse
    {
        $strand = $this->strandService->find($id);
        $strand->delete();
        return response()->json(['message' => 'Strand deleted successfully']);
    }
}

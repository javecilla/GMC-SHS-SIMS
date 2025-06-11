<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\UserRole;
use App\Services\UserRoleService;
use App\Http\Requests\Api\V1\StoreUserRoleRequest;
use App\Http\Requests\Api\V1\UpdateUserRoleRequest;
use App\Http\Resources\Api\V1\UserRoleResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class UserRoleController extends Controller
{
    public function __construct(
        protected UserRoleService $userRoleService,
    ) {}

    public function index(): ResourceCollection
    {
        $userRoles = $this->userRoleService->list();
        return UserRoleResource::collection($userRoles);
    }

    public function store(StoreUserRoleRequest $request): UserRoleResource
    {
        $userRole = $this->userRoleService->create($request->validated());
        return new UserRoleResource($userRole);
    }

    public function show(int $id): UserRoleResource
    {
        $userRole = $this->userRoleService->find($id);
        return new UserRoleResource($userRole);
    }

    public function update(UpdateUserRoleRequest $request, int $id): UserRoleResource
    {
        $userRole = $this->userRoleService->find($id);
        $userRole->update($request->validated());
        return new UserRoleResource($userRole);
    }

    public function destroy(int $id): JsonResponse
    {
        $userRole = $this->userRoleService->find($id);
        $userRole->delete();
        return response()->json(['message' => 'User role deleted successfully']);
    }
}
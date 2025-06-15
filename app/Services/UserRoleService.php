<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\UserRole;

class UserRoleService
{
  public function list(): Collection
  {
    return UserRole::all();
  }

  public function create(array $data): UserRole
  {
    return UserRole::create($data);
  }

  public function find(int $id): UserRole
  {
    return UserRole::findOrFail($id);
  }

  //get user role by role name
  public function findByValue(string $roleName): UserRole
  {
    return UserRole::where('role_name', $roleName)->firstOrFail();
  }

  public function update(UserRole $userRole, array $data): UserRole
  {
    $userRole->update($data);
    return $userRole;
  }

  public function delete(UserRole $userRole): void
  {
    $userRole->delete();
  }
}
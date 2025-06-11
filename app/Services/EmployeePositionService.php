<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\EmployeePosition;

class EmployeePositionService
{
  public function list(): Collection
  {
    return EmployeePosition::all();
  }

  public function create(array $data): EmployeePosition
  {
    return EmployeePosition::create($data);
  }

  public function find(int $id): EmployeePosition
  {
    return EmployeePosition::findOrFail($id);
  }

  public function update(EmployeePosition $employeePosition, array $data): EmployeePosition
  {
    $employeePosition->update($data);
    return $employeePosition;
  }

  public function delete(EmployeePosition $employeePosition): void
  {
    $employeePosition->delete();
  }
}
<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\ScheduleCategory;

class ScheduleCategoryService
{
  public function list(): Collection
  {
    return ScheduleCategory::all();
  }

  public function create(array $data): ScheduleCategory
  {
    return ScheduleCategory::create($data);
  }

  public function find(int $id): ScheduleCategory
  {
    return ScheduleCategory::findOrFail($id);
  }

  public function update(ScheduleCategory $scheduleCategory, array $data): ScheduleCategory
  {
    $scheduleCategory->update($data);
    return $scheduleCategory;
  }

  public function delete(ScheduleCategory $scheduleCategory): void
  {
    $scheduleCategory->delete();
  }
}
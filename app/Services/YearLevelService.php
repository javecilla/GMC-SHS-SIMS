<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\YearLevel;

class YearLevelService
{
  public function list(): Collection
  {
    return YearLevel::all();
  }

  public function create(array $data): YearLevel
  {
    return YearLevel::create($data);
  }

  public function find(int $id): YearLevel
  {
    return YearLevel::findOrFail($id);
  }

  public function update(YearLevel $yearLevel, array $data): YearLevel
  {
    $yearLevel->update($data);
    return $yearLevel;
  }

  public function delete(YearLevel $yearLevel): void
  {
    $yearLevel->delete();
  }
}

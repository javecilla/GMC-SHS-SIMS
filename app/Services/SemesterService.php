<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Semester;

class SemesterService
{
  public function list(): Collection
  {
    return Semester::all();
  }

  public function create(array $data): Semester
  {
    return Semester::create($data);
  }

  public function find(int $id): Semester
  {
    return Semester::findOrFail($id);
  }

  public function update(Semester $semester, array $data): Semester
  {
    $semester->update($data);
    return $semester;
  }

  public function delete(Semester $semester): void
  {
    $semester->delete();
  }
}

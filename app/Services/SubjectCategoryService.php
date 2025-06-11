<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\SubjectCategory;

class SubjectCategoryService
{
  public function list(): Collection
  {
    return SubjectCategory::all();
  }

  public function create(array $data): SubjectCategory
  {
    return SubjectCategory::create($data);
  }

  public function find(int $id): SubjectCategory
  {
    return SubjectCategory::findOrFail($id);
  }

  public function update(SubjectCategory $subjectCategory, array $data): SubjectCategory
  {
    $subjectCategory->update($data);
    return $subjectCategory;
  }

  public function delete(SubjectCategory $subjectCategory): void
  {
    $subjectCategory->delete();
  }
}

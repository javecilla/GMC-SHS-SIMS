<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Subject;

class SubjectService
{
  public function list(): Collection
  {
    return Subject::all();
  }

  public function create(array $data): Subject
  {
    return Subject::create($data);
  }

  public function find(int $id): Subject
  {
    return Subject::findOrFail($id);
  }

  public function update(Subject $subject, array $data): Subject
  {
    $subject->update($data);
    return $subject;
  }

  public function delete(Subject $subject): void
  {
    $subject->delete();
  }
}

<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Section;

class SectionService
{
  public function list(): Collection
  {
    return Section::all();
  }

  public function create(array $data): Section
  {
    return Section::create($data);
  }

  public function find(int $id): Section
  {
    return Section::findOrFail($id);
  }

  public function update(Section $section, array $data): Section
  {
    $section->update($data);
    return $section;
  }

  public function delete(Section $section): void
  {
    $section->delete();
  }
}

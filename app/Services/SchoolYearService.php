<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\SchoolYear;

class SchoolYearService
{
  public function list(): Collection
  {
    return SchoolYear::all();
  }

  public function create(array $data): SchoolYear
  {
    return SchoolYear::create($data);
  }

  public function find(int $id): SchoolYear
  {
    return SchoolYear::findOrFail($id);
  }

  public function current(): SchoolYear
  {
    /**
     * Retrieve the current school year, prioritizing is_current = true
     * If no such row exists, return the most recent school year by school_year_name
     */
    return SchoolYear::orderBy('is_current', 'desc')
                     ->orderBy('school_year_name', 'desc')
                     ->first();
  }

  public function update(SchoolYear $schoolYear, array $data): SchoolYear
  {
    $schoolYear->update($data);
    return $schoolYear;
  }

  public function delete(SchoolYear $schoolYear): void
  {
    $schoolYear->delete();
  }
}

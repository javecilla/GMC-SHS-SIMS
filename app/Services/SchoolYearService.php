<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\SchoolYear;
use App\Exceptions\Api\V1\CurrentSchoolYearConflictException;
use App\Http\Resources\Api\V1\SchoolYearResource;

class SchoolYearService
{
  public function list(): Collection
  {
    return SchoolYear::all();
  }

  public function create(array $data): SchoolYear
  {
    try {
      // Check if new entry wants to be "current"
      if (!empty($data['is_current']) && $data['is_current'] === true) {
        $current = SchoolYear::where('is_current', true)->first();

        if($current)
          throw new CurrentSchoolYearConflictException(data: ['current_school_year' => new SchoolYearResource($current)]);
      }

      return SchoolYear::create($data);
    } catch (QueryException $e) {
      throw $e;
    }
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
    try {
      if (!empty($data['is_current']) && $data['is_current'] === true) {
        $current = SchoolYear::where('is_current', true)->first();

        if($current)
          throw new CurrentSchoolYearConflictException(data: ['current_school_year' => new SchoolYearResource($current)]);
      }

      $schoolYear->update($data);
      return $schoolYear;
    } catch (QueryException $e) {
      throw $e;
    }
  }

  public function delete(SchoolYear $schoolYear): void
  {
    $schoolYear->delete();
  }
}

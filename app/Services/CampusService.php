<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Campus;

class CampusService
{
  public function list(): Collection
  {
    return Campus::all();
  }

  public function create(array $data): Campus
  {
    return Campus::create($data);
  }

  public function find(int $id): Campus
  {
    return Campus::findOrFail($id);
  }

  public function update(Campus $campus, array $data): Campus
  {
    $campus->update($data);
    return $campus;
  }

  public function delete(Campus $campus): void
  {
    $campus->delete();
  }
}

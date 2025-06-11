<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Strand;

class StrandService
{
  public function list(): Collection
  {
    return Strand::all();
  }

  public function create(array $data): Strand
  {
    return Strand::create($data);
  }

  public function find(int $id): Strand
  {
    return Strand::findOrFail($id);
  }

  public function update(Strand $strand, array $data): Strand
  {
    $strand->update($data);
    return $strand;
  }

  public function delete(Strand $strand): void
  {
    $strand->delete();
  }
}

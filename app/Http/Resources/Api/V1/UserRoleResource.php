<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRoleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Add a safety check in case null is passed
        if (!$this->resource) {
            return [];
        }
        
        return [
            'id' => $this->id,
            'role_name' => $this->role_name,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
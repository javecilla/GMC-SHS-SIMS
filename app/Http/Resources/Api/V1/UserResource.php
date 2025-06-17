<?php

namespace App\Http\Resources\Api\V1;

use App\Http\Resources\Api\V1\UserRoleResource;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Add a safety check in case null is passed
        if (!$this->resource) {
            return [];
        }
        
        return [
            'id' => $this->id,
            'role' => $this->whenLoaded('userRole', function() {
                return new UserRoleResource($this->userRole);
            }, $this->role),
            'user_uid' => $this->user_uid,
            'user_no' => $this->user_no,
            'user_status' => $this->user_status,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'image_profile' => $this->image_profile,
            'e_signature' => $this->e_signature,
            'first_login_at' => $this->first_login_at,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}

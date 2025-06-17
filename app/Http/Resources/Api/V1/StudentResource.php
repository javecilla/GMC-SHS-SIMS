<?php

namespace App\Http\Resources\Api\V1;

use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

//TODO: fixed the relationship
class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lrn' => $this->lrn,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'extension_name' => $this->extension_name,
            'full_name' => $this->getFullNameAttribute(),
            'gender' => $this->gender->value,
            'birthdate' => $this->birthdate->format('Y-m-d'),
            'birthplace' => $this->birthplace,
            'contact_no' => $this->contact_no,
            'nationality' => $this->nationality,
            'religion' => $this->religion,
            'house_address' => $this->house_address,
            'barangay' => $this->barangay,
            'municipality' => $this->municipality,
            'province' => $this->province,
            'postal_code' => $this->postal_code,
            'full_address' => $this->getFullAddressAttribute(),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
            'account' => $this->whenLoaded('account', function() {
                return new UserResource($this->account);
            }),
        ];
    }
}

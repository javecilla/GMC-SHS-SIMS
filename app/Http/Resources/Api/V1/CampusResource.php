<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampusResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'campus_name' => $this->campus_name,
            'campus_code' => $this->campus_code,
            'deped_school_id' => $this->deped_school_id,
            'shs_permit_no' => $this->shs_permit_no,
            'full_address' => $this->full_address,
            'contact_no' => $this->contact_no,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}

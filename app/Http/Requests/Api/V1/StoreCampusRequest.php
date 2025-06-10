<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCampusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin' or 'Administration' for creating new Campus
    }

    public function rules(): array
    {
        return [
            'campus_name' => ['required', 'string', 'max:150', Rule::unique('campuses','campus_name')],
            'campus_code' => ['required', 'string', 'max:30', Rule::unique('campuses', 'campus_code')],
            'deped_school_id' => ['nullable', 'string', 'max:50', Rule::unique('campuses', 'deped_school_id')],
            'shs_permit_no' => ['nullable', 'string', 'max:100', Rule::unique('campuses', 'shs_permit_no')],
            'full_address' => ['nullable', 'string', 'max:500'],
            'contact_no' => ['nullable', 'string', 'max:15'],
        ];
    }

    public function messages(): array
    {
        return [
            'campus_name.unique' => 'The campus name is already taken.',
            'campus_code.unique' => 'The campus code is already taken.',
            'deped_school_id.unique' => 'The DepEd school ID is already taken.',
            'shs_permit_no.unique' => 'The SHS permit number is already taken.',
        ];
    }
}

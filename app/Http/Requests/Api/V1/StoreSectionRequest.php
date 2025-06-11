<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin' or 'Administration' or 'Academic Coordinator' for creating new Section
    }

    public function rules(): array
    {
        return [
            'section_name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('sections','section_name')
            ],
        ];
    }

    public function messages(): array
    {
        return [
           'section_name.unique' => 'The section name has already been taken.',
        ];
    }
}

<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreYearLevelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin','Administration' or 'Academic Coordinator' for creating new Year Level
    }

    public function rules(): array
    {
        return [
            'year_level_name' => [
                'required',
                'string',
                'max:20',
                Rule::unique('year_levels','year_level_name')
            ],
            'year_level_code' => [
               'required',
               'string',
               'max:5',
                Rule::unique('year_levels','year_level_code')
            ],
            'level_order' => [
                'required',
                'numeric',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'year_level_name.unique' => 'The year level name has already been taken.',
            'year_level_code.unique' => 'The year level code has already been taken.',
        ];
    }
}

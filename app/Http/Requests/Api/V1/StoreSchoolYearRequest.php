<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSchoolYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin' or 'Administration' or 'Academic Coordinator' for creating new School Year
    }

    public function rules(): array
    {
        return [
            'school_year_name' => [
                'required',
                'string',
                'max:20',
                'regex:/^\d{4}-\d{4}$/',
                Rule::unique('school_years','school_year_name')
            ],
            'is_current' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
           'school_year_name.regex' => 'The school year name must be in the format YYYY-YYYY (e.g., 2022-2023)',
           'school_year_name.unique' => 'The school year name has already been taken.',
        ];
    }
}

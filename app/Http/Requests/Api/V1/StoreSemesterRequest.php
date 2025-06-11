<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSemesterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin' or 'Administration' for creating new Semester
    }

    public function rules(): array
    {
        return [
            'semester_name' => [
                'required',
                'string',
                'max:20',
                Rule::unique('semesters','semester_name')
            ],
            'semester_code' => [
               'required',
               'string',
               'max:5',
                Rule::unique('semesters','semester_code')
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'semester_name.unique' => 'The semester name has already been taken.',
            'semester_code.unique' => 'The semester code has already been taken.',
        ];
    }
}

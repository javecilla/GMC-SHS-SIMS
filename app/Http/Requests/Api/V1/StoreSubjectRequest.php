<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin' or 'Administration' or 'Academic Coordinator' for creating new Subject
    }

    public function rules(): array
    {
        return [
            'subject_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('subjects','subject_name')
            ],
        ];
    }

    public function messages(): array
    {
        return [
           'subject_name.unique' => 'The subject name has already been taken.',
        ];
    }
}

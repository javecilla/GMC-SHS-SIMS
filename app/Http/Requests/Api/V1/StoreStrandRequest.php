<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin','Administration' or 'Academic Coordinator' for creating new Strand
    }

    public function rules(): array
    {
        return [
            'strand_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('strands','strand_name')
            ],
            'strand_code' => [
               'required',
               'string',
               'max:10',
                Rule::unique('strands','strand_code')
            ],
            'strand_description' => [
                'nullable',
                'string',
                'max:500',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'strand_name.unique' => 'The strand name has already been taken.',
            'strand_code.unique' => 'The strand code has already been taken.',
        ];
    }
}

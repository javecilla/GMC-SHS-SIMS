<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeePositionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin' or 'Administration' for creating new Employee Position
    }

    public function rules(): array
    {
        return [
            'position_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('employee_positions','position_name')
            ],
        ];
    }

    public function messages(): array
    {
        return [
           'position_name.unique' => 'The position name has already been taken.',
        ];
    }
}
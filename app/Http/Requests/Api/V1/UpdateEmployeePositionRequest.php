<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeePositionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin' or 'Administration' for updating Employee Position
    }

    public function rules(): array
    {
        $employeePositionId = $this->route('id');

        return [
            'position_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('employee_positions','position_name')->ignore($employeePositionId),
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
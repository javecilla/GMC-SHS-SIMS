<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin' for creating new User Role
    }

    public function rules(): array
    {
        return [
            'role_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('user_roles','role_name')
            ],
        ];
    }

    public function messages(): array
    {
        return [
           'role_name.unique' => 'The role name has already been taken.',
        ];
    }
}
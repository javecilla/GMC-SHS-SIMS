<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin' for updating User Role
    }

    public function rules(): array
    {
        $userRoleId = $this->route('id');

        return [
            'role_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('user_roles','role_name')->ignore($userRoleId),
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
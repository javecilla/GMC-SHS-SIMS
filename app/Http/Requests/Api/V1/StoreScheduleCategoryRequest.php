<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreScheduleCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin' or 'Administration' for creating new Schedule Category
    }

    public function rules(): array
    {
        return [
            'category_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('schedule_categories','category_name')
            ],
        ];
    }

    public function messages(): array
    {
        return [
           'category_name.unique' => 'The category name has already been taken.',
        ];
    }
}
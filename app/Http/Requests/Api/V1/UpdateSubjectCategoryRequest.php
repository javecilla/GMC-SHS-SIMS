<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubjectCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin' or 'Administration' or 'Academic Coordinator' for updating Subject Category
    }

    public function rules(): array
    {
        $subjectCategoryId = $this->route('id');
        
        return [
            'category_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('subject_categories','category_name')->ignore($subjectCategoryId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'category_name.unique' => 'The subject category name has already been taken.',
        ];
    }
}

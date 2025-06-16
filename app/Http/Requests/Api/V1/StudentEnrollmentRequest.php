<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\EnrollmentStatusEnum;
use App\Enums\LearningModeEnum;
use App\Enums\TuitionStatusEnum;
use App\Enums\EnrollmentVerificationStatusEnum;
use Illuminate\Validation\Rule;

class StudentEnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin','Administration','Academic Coordinator' or 'Student' for perfoming Student enrollment for academic year
    }

    public function rules(): array
    {
        return [
            'student' => ['required', 'numeric'],
            'enrollment_status' => ['required', 'string', Rule::in(EnrollmentStatusEnum::values())],
            'learning_mode' => ['required', 'string', Rule::in(LearningModeEnum::values())],
            'tuition_status' => ['required', 'string', Rule::in(TuitionStatusEnum::values())],
            'verification_status' => ['required', 'string', Rule::in(EnrollmentVerificationStatusEnum::values())],
            'section' => ['required', 'numeric'],
            'strand' => ['required', 'numeric'],
            'year_level' => ['required', 'numeric'],
            'school_year' => ['required', 'numeric'],
            'semester' => ['required', 'numeric'],
            'campus' => ['required', 'numeric'],
        ];
    }
}

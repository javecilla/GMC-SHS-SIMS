<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\GenderEnum;
use App\Enums\CompleterAsEnum;
use App\Enums\SchoolStatus;
use App\Enums\EnrollmentStatusEnum;
use App\Enums\LearningModeEnum;
use App\Enums\TuitionStatusEnum;
use App\Enums\EnrollmentVerificationStatusEnum;
use Illuminate\Validation\Rule;

class StudentRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //TODO: only allowed 'Super Admin','Administration','Academic Coordinator' or 'Student' for perfoming Student registration
    }

    public function rules(): array
    {
        return [
            #users
            'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users','email')],
            'image_profile' => ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'], //1MB
            'e_signature' => ['required', 'image', 'max:512', 'mimes:png'], //512KB
            #students
            'lrn' => ['nullable', 'string', 'max:12', Rule::unique('students','lrn')],
            'first_name' => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'extension_name' => ['nullable', 'string', 'max:20'],
            'gender' => ['required', 'string', Rule::in(GenderEnum::values())],
            'birthdate' => ['required', 'date'],
            'birthplace' => ['required', 'string', 'max:500'],
            'contact_no' => ['required', 'string', 'max:11'],
            'nationality' => ['nullable', 'string', 'max:50'],
            'religion' => ['nullable', 'string', 'max:50'],
            'house_address' => ['nullable', 'string', 'max:200'],
            'barangay' => ['nullable', 'string', 'max:100'],
            'municipality' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            #contact_persons
            'father_full_name' => ['nullable', 'string', 'max:200'],
            'father_occupation' => ['nullable', 'string', 'max:50'],
            'father_contact_no' => ['nullable', 'string', 'max:11'],
            'mother_full_name' => ['nullable', 'string', 'max:200'],
            'mother_occupation' => ['nullable', 'string', 'max:50'],
            'mother_contact_no' => ['nullable', 'string', 'max:11'],
            'guardian_full_name' => ['required', 'string', 'max:200'],
            'guardian_occupation' => ['nullable', 'string', 'max:50'],
            'guardian_contact_no' => ['required', 'string', 'max:11'],
            'guardian_relationship' => ['required', 'string', 'max:100'],
            'guardian_full_address' => ['required', 'string', 'max:500'],
            #academic_histories
            'school_name' => ['required', 'string', 'max:200'],
            'school_address' => ['nullable', 'string', 'max:500'],
            'school_status' => ['required', 'string', Rule::in(SchoolStatus::values())],
            'completer_as' => ['required', 'string', Rule::in(CompleterAsEnum::values())],
            'completion_date' => ['nullable', 'date'],
            'gwa' => ['nullable', 'numeric'],
            #student_enrollments
            //'enrollment_status' => ['required', 'string', Rule::in(EnrollmentStatusEnum::values())],
            'learning_mode' => ['required', 'string', Rule::in(LearningModeEnum::values())],
            'tuition_status' => ['required', 'string', Rule::in(TuitionStatusEnum::values())],
            //'verification_status' => ['required', 'string', Rule::in(EnrollmentVerificationStatusEnum::values())],
            //'section' => ['required', 'numeric'],
            'strand' => ['required', 'numeric'],
            'year_level' => ['required', 'numeric'],
            'school_year' => ['required', 'numeric'],
            'semester' => ['required', 'numeric'],
            'campus' => ['required', 'numeric'],
        ];
    }
}

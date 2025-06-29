<?php

namespace App\Http\Resources\Api\V1;

use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\FormatHelper;
use App\Helpers\CalculatorHelper;
use Carbon\Carbon;

//TODO: fixed the relationship
class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lrn' => $this->lrn,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'extension_name' => $this->extension_name,
            'full_name' => $this->getFullNameAttribute(),
            'gender' => $this->gender->value,
            'birthdate' => $this->birthdate->format('Y-m-d'),
            'birthplace' => $this->birthplace,
            'contact_no' => $this->contact_no,
            'nationality' => $this->nationality,
            'religion' => $this->religion,
            'house_address' => $this->house_address,
            'barangay' => $this->barangay,
            'municipality' => $this->municipality,
            'province' => $this->province,
            'postal_code' => $this->postal_code,
            'full_address' => $this->getFullAddressAttribute(),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
            'account' => $this->whenLoaded('account', function() {
                return new UserResource($this->account);
            }),
        ];
    }

    public static function academic(array $data): array
    {
        return [
      'student' => [
        //'id' => $data['id'],
        'student_no' => $data['account']['user_no'],
        'lrn' => $data['lrn'],
        'first_name' => $data['first_name'],
        'middle_name' => $data['middle_name'],
        'last_name' => $data['last_name'],
        'extension_name' => $data['extension_name'],
        'full_name' => FormatHelper::formatPersonName(
          $data['last_name'],
          $data['first_name'],
          $data['middle_name'],
          $data['extension_name']
        ),
        'birthdate' => Carbon::parse($data['birthdate'])->format('M j, Y'),
        'age' => CalculatorHelper::calculateAge($data['birthdate']),
        'birthplace' => $data['birthplace'],
        'contact_no' => $data['contact_no'],
        'email' => $data['account']['email'],
        'nationality' => $data['nationality'],
        'religion' => $data['religion'],
        'house_address' => $data['house_address'],
        'barangay' => $data['barangay'],
        'municipality' => $data['municipality'],
        'province' => $data['province'],
        'postal_code' => $data['postal_code'],
        'full_address' => FormatHelper::formatAddress(
          $data['house_address'],
          $data['barangay'],
          $data['municipality'],
          $data['province'],
          $data['postal_code'],
        ),
        'image_profile' => $data['account']['image_profile'],
        'e_signature' => $data['account']['e_signature'],
      ],
      'contact_person' => [
        'father_full_name' => $data['contact_person']['father_full_name'],
        'father_occupation' => $data['contact_person']['father_occupation'],
        'father_contact_no' => $data['contact_person']['father_contact_no'],
        'mother_full_name' => $data['contact_person']['mother_full_name'],
        'mother_occupation' => $data['contact_person']['mother_occupation'],
        'mother_contact_no' => $data['contact_person']['mother_contact_no'],
        'guardian_full_name' => $data['contact_person']['guardian_full_name'],
        'guardian_occupation' => $data['contact_person']['guardian_occupation'],
        'guardian_contact_no' => $data['contact_person']['guardian_contact_no'],
        'guardian_relationship' => $data['contact_person']['guardian_relationship'],
        'guardian_full_address' => $data['contact_person']['guardian_full_address'],
      ],
      'academic_history' => [
        'school_name' => $data['academic_history']['school_name'],
        'school_address' => $data['academic_history']['school_address'],
        'school_status' => $data['academic_history']['school_status'],
        'completion_date' => Carbon::parse($data['academic_history']['completion_date'])->format('M j, Y'),
        'completer_as' => $data['academic_history']['completer_as'],
        'gwa' => $data['academic_history']['gwa'],
      ],
      'document' => $data['document'] ? [
        'psa_remarks' => $data['document']['psa_remarks'],
        'psa_image' => $data['document']['psa_image'],
        'psa_status' => $data['document']['psa_status'],
        'card_remarks' => $data['document']['card_remarks'],
        'card_image' => $data['document']['card_image'],
        'card_status' => $data['document']['card_status'],
        'f137_remarks' => $data['document']['f137_remarks'],
        'f137_remarks' => $data['document']['f137_remarks'],
        'f137_status' => $data['document']['f137_status'],
        'good_moral_remarks' => $data['document']['good_moral_remarks'],
        'good_moral_remarks' => $data['document']['good_moral_remarks'],
        'good_moral_status' => $data['document']['good_moral_status'],
        'waiver_image' => $data['document']['waiver_image'],
        'coe_image' => $data['document']['coe_image'],
      ] : null,
      'freebies' => $data['freebies'] ? [
        'uniform_shirt' => $data['freebies']['uniform_shirt'],
        'uniform_pants' => $data['freebies']['uniform_pants'],
        'uniform_received_date' => Carbon::parse($data['freebies']['uniform_received_date'])->format('M j, Y'),
        'pe_shirt' => $data['freebies']['pe_shirt'],
        'pe_pants' => $data['freebies']['pe_pants'],
        'pe_received_date' => Carbon::parse($data['freebies']['pe_received_date'])->format('M j, Y'),
        'id_card' => $data['freebies']['id_card'],
        'id_lace' => $data['freebies']['id_lace'],
        'id_jacket' => $data['freebies']['id_jacket'],
        'id_received_date' => Carbon::parse($data['freebies']['id_received_date'])->format('M j, Y'),
      ] : null,
      'enrollment' => [
        'enrollment_no' => $data['student_enrollments'][0]['enrollment_no'],
        'enrollment_date' => Carbon::parse($data['student_enrollments'][0]['enrollment_date'])->format('M j, Y'),
        'strand' => $data['student_enrollments'][0]['strand']['strand_name'],
        'year_level' => $data['student_enrollments'][0]['year_level']['level_order'],
        'section' => $data['student_enrollments'][0]['section'] ? $data['student_enrollments'][0]['section']['section_name'] : null,
        'school_year' => $data['student_enrollments'][0]['school_year']['school_year_name'],
        'semester' => $data['student_enrollments'][0]['semester']['semester_name'],
        'campus' => $data['student_enrollments'][0]['campus']['campus_name'],
        'enrollment_status' => $data['student_enrollments'][0]['enrollment_status'],
        'learning_mode' => $data['student_enrollments'][0]['learning_mode'],
        'tuition_status' => $data['student_enrollments'][0]['tuition_status'],
        'verification_status' => $data['student_enrollments'][0]['verification_status'],
      ],
    ];
    }
}

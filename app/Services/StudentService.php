<?php

namespace App\Services;

use App\Models\Student;
use App\Models\ContactPerson as StudentContactPerson;
use App\Models\AcademicHistory as StudentAcademicHistory;
use App\Models\Document as StudentDocument;
use App\Models\StudentEnrollment;
use App\Models\Referral;
use App\Models\Freebies;
use App\Services\UserService;
use App\Services\UserRoleService;
use App\Enums\UserRoleEnum;
use App\Enums\UserStatusEnum;
use App\Enums\EnrollmentStatusEnum;
use App\Enums\EnrollmentVerificationStatusEnum;
use App\Helpers\GeneratorHelper;
use App\Helpers\FormatHelper;
use App\Helpers\CalculatorHelper;
use App\Helpers\ScheduleHelper;
use App\Mail\StudentRegistered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Exceptions\Api\V1\StudentNotFoundException;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\Api\V1\StudentResource;

class StudentService
{
  public function __construct(
    protected UserService $userService,
    protected UserRoleService $userRoleService
  ) {}

  public function find(int $id): Student
  {
    return Student::findOrFail($id);
  }

  public function getAcademicDetails(string $studentNo): StudentResource | array
  {
    $student = Student::with([
      'account',
      'account.userRole',
      'contactPerson',
      'academicHistory',
      'document',
      'freebies',
      'studentEnrollments' => function($query) {
        $query->latest()->first();
      },
      'studentEnrollments.strand',
      'studentEnrollments.yearLevel',
      'studentEnrollments.schoolYear',
      'studentEnrollments.semester',
      'studentEnrollments.campus',
    ])->whereHas('account', function($query) use ($studentNo) {
      $query->where('user_no', $studentNo);
    })->first();

    if(!$student) throw new StudentNotFoundException("Can't find student with no '{$studentNo}'");

    return StudentResource::academic($student->toArray());
  }

  // Registration during admission
  public function register(array $data): ?array
  {
    try {
      return DB::transaction(function () use ($data) {
        $userNo = GeneratorHelper::generateUserNo();
        $defaultPassword = Carbon::parse($data['birthdate'])->format('Y') . Str::upper($data['last_name']);
        $userRole = $this->userRoleService->findByValue(UserRoleEnum::Student->value);

        $user = $this->userService->create([
          'email' => $data['email'],
          'user_no' => $userNo,
          'password' => $defaultPassword,
          'role' => $userRole->id,
          'image_profile' => $data['image_profile'],
          'e_signature' => $data['e_signature'],
        ]);

        $student = Student::create([
          'lrn' => $data['lrn'],
          'first_name' => $data['first_name'],
          'last_name' => $data['last_name'],
          'middle_name' => $data['middle_name'],
          'extension_name' => $data['extension_name'],
          'gender' => $data['gender'],
          'birthdate' => $data['birthdate'],
          'birthplace' => $data['birthplace'],
          'contact_no' => $data['contact_no'],
          'nationality' => $data['nationality'],
          'religion' => $data['religion'],
          'house_address' => $data['house_address'],
          'barangay' => $data['barangay'],
          'municipality' => $data['municipality'],
          'province' => $data['province'],
          'postal_code' => $data['postal_code'],
          'account' => $user->id,
        ]);

        StudentContactPerson::create([
          'student' => $student->id,
          'father_full_name' => $data['father_full_name'],
          'father_occupation' => $data['father_occupation'],
          'father_contact_no' => $data['father_contact_no'],
          'mother_full_name' => $data['mother_full_name'],
          'mother_occupation' => $data['mother_occupation'],
          'mother_contact_no' => $data['mother_contact_no'],
          'guardian_full_name' => $data['guardian_full_name'],
          'guardian_occupation' => $data['guardian_occupation'],
          'guardian_contact_no' => $data['guardian_contact_no'],
          'guardian_relationship' => $data['guardian_relationship'],
          'guardian_full_address' => $data['guardian_full_address'],
        ]);

        StudentAcademicHistory::create([
          'student' => $student->id,
          'school_name' => $data['school_name'],
          'school_address' => $data['school_address'],
          'school_status' => $data['school_status'],
          'completion_date' => $data['completion_date'],
          'gwa' => $data['gwa'],
          'completer_as' => $data['completer_as'],
        ]);

        //Upon student registration thier enrollment status is 'Pending' as Registrar need to verify it first.
        $defaultEnrollmentStatus = EnrollmentStatusEnum::Pending->value;
        $defaultVerificationStatus = EnrollmentVerificationStatusEnum::Pending->value;

        $enrollment = $this->enroll([
          'enrollment_status' => $defaultEnrollmentStatus,
          'learning_mode' => $data['learning_mode'],
          'tuition_status' => $data['tuition_status'],
          'verification_status' => $defaultVerificationStatus,
          'student' => $student->id,
          //'section' => $data['section'],
          'strand' => $data['strand'],
          'year_level' => $data['year_level'],
          'school_year' => $data['school_year'],
          'semester' => $data['semester'],
          'campus' => $data['campus'],
        ]);

        $appointedSchedule = ScheduleHelper::generateStudentAppointment($enrollment->enrollment_date);

        $registeredStudent = [
          'appointment_schedule' => $appointedSchedule,
          'enrollment_no' => $enrollment->enrollment_no,
          'enrollment_date' => Carbon::parse($enrollment->enrollment_date)->format('M j, Y'),
          'enrollment_status' => $enrollment->enrollment_status,
          'verification_status' => $enrollment->verification_status,
          'learning_mode' => $enrollment->learning_mode,
          'tuition_status' => $enrollment->tuition_status,
          'strand' => $data['strand_name'],
          'year_level' => $data['year_level_order'],
          'school_year' => $data['school_year_name'],
          'semester' => $data['semester_code'],
          'campus' => $data['campus_name'],
          'campus_address' => $data['campus_address'],
          'student_no' => $user->user_no,
          'lrn' => $student->lrn,
          // 'full_name' => FormatHelper::formatPersonName(
          //   $data['last_name'],
          //   $data['first_name'],
          //   $data['middle_name'],
          //   $data['extension_name']
          // ),
          'first_name' => $student->first_name,
          'last_name' => $student->last_name,
          'middle_name' => $student->middle_name,
          'extension_name' => $student->extension_name,
          'email' => $user->email,
          'gender' => $student->gender->value,
          'birthdate' => Carbon::parse($data['birthdate'])->format('M j, Y'),
          'age' => CalculatorHelper::calculateAge($student->birthdate),
        ];

        $mailer = Mail::to($user->email);
        $mailer->send(new StudentRegistered($registeredStudent));

        return $registeredStudent;
      }, 2);
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  // Enrollment for new academic year
  public function enroll(array $data): StudentEnrollment
  {
    $data['enrollment_no'] = GeneratorHelper::generateEnrollmentNo();
    $data['enrollment_date'] = Carbon::now()->format('Y-m-d');

    return StudentEnrollment::create($data);
  }

  public function createDocument(array $data): StudentDocument
  {
    $psaFileName = GeneratorHelper::generateFileName('IMG', 'psa', $data['psa_image']->getClientOriginalExtension());
    $cardFileName = GeneratorHelper::generateFileName('IMG', 'card', $data['card_image']->getClientOriginalExtension());
    $f137FileName = GeneratorHelper::generateFileName('IMG', 'f137', $data['f137_image']->getClientOriginalExtension());
    $goodMoralFileName = GeneratorHelper::generateFileName('IMG', 'goodmoral', $data['good_moral_image']->getClientOriginalExtension());
    $waiverFileName = GeneratorHelper::generateFileName('IMG', 'waiver', $data['waiver_image']->getClientOriginalExtension());
    $coeFileName = GeneratorHelper::generateFileName('IMG', 'coe', $data['coe_image']->getClientOriginalExtension());

    Storage::disk('public')->put('student/psa/' . $psaFileName, file_get_contents($data['psa_image']));
    Storage::disk('public')->put('student/card/' . $cardFileName, file_get_contents($data['card_image']));
    Storage::disk('public')->put('student/f137/' . $f137FileName, file_get_contents($data['f137_image']));
    Storage::disk('public')->put('student/good_moral/' . $goodMoralFileName, file_get_contents($data['good_moral_image']));
    Storage::disk('public')->put('student/waiver/' . $waiverFileName, file_get_contents($data['waiver_image']));
    Storage::disk('public')->put('student/coe/' . $coeFileName, file_get_contents($data['coe_image']));

    $data['psa_image'] = $psaFileName;
    $data['card_image'] = $cardFileName;
    $data['f137_image'] = $f137FileName;
    $data['good_moral_image'] = $goodMoralFileName;
    $data['waiver_image'] = $waiverFileName;
    $data['coe_image'] = $coeFileName;
    
    return StudentDocument::create($data);
  }

  public function createReferral(array $data): Referral
  {
    return Referral::create($data);
  }

  public function createFreebies(array $data): Freebies
  {
    $data['pe_received_date'] = Carbon::now()->format('Y-m-d');
    $data['uniform_received_date'] = Carbon::now()->format('Y-m-d');
    $data['id_received_date'] = Carbon::now()->format('Y-m-d');

    return Freebies::create($data);
  }

}

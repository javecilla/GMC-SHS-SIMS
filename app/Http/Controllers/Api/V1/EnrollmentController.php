<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\StudentService;
// use App\Services\SectionService;
use App\Services\StrandService;
use App\Services\YearLevelService;
use App\Services\SchoolYearService;
use App\Services\SemesterService;
use App\Services\CampusService;
use App\Http\Requests\Api\V1\StudentRegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EnrollmentController extends Controller
{
    public function __construct(
        protected StudentService $studentService,
       // protected SectionService $sectionService,
        protected StrandService $strandService,
        protected YearLevelService $yearLevelService,
        protected SchoolYearService $schoolYearService,
        protected SemesterService $semesterService,
        protected CampusService $campusService,
    ) {}

    public function register(StudentRegistrationRequest $request): JsonResponse
    {
        $data = $request->validated();
        //retrieve info
        $strand = $this->strandService->find($data['strand']);
        $yearLevel = $this->yearLevelService->find($data['year_level']);
        $schoolYear = $this->schoolYearService->find($data['school_year']);
        $semester = $this->semesterService->find($data['semester']);
        $campus = $this->campusService->find($data['campus']);

        $registeredStudent = $this->studentService->register($data);

        $registeredStudent['strand']  = $strand->strand_name;
        $registeredStudent['year_level']  = $yearLevel->level_order;
        $registeredStudent['school_year']  = $schoolYear->school_year_name;
        $registeredStudent['semester']  = $semester->semester_code;
        $registeredStudent['campus']  = $campus->campus_name;

        return response()->json([
            'message' => 'Student registered successfully',
            'data' => $registeredStudent
        ], 201);
    }
}

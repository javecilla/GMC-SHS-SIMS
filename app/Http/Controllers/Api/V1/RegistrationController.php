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

class RegistrationController extends Controller
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

    public function student(StudentRegistrationRequest $request): JsonResponse
    {
        $data = $request->validated();
        //retrieve info
        $strand = $this->strandService->find($data['strand']);
        $yearLevel = $this->yearLevelService->find($data['year_level']);
        $schoolYear = $this->schoolYearService->find($data['school_year']);
        $semester = $this->semesterService->find($data['semester']);
        $campus = $this->campusService->find($data['campus']);

        $data['strand_name']  = $strand->strand_name;
        $data['year_level_order']  = $yearLevel->level_order;
        $data['school_year_name']  = $schoolYear->school_year_name;
        $data['semester_code']  = $semester->semester_code;
        $data['campus_name']  = $campus->campus_name;
        $data['campus_address']  = $campus->full_address;

        $registeredStudent = $this->studentService->register($data);

        return response()->json([
            'message' => 'Student registered successfully',
            'data' => $registeredStudent
        ], 201);
    }
}

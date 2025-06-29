<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\StudentService;
#use App\Http\Resources\Api\V1\StudentResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    public function __construct(
        protected StudentService $studentService,
    ) {}

    public function getAcademicDetails(string $studentNo): JsonResponse
    {
        $student = $this->studentService->getAcademicDetails($studentNo);
        // if(!$student) {
        //     return response()->json(['message' => "Can't find student with no '{$studentNo}'"], 404);
        // }
        return response()->json(['message' => 'Student details fetched successfully', 'data' => $student], 200);
    }
}

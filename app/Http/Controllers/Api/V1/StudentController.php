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

    public function getDetails(int $id): JsonResponse
    {
        $student = $this->studentService->getDetails($id);
        return response()->json([
            'message' => 'Student details fetched successfully',
            'data' => $student,
        ], 200);
    }
}

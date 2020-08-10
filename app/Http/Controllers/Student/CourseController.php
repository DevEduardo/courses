<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\StudentCourse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __invoke()
    {
        $data = request()->validate([
            'student_id' => 'required',
            'course_id' => 'required'
        ]);

        StudentCourse::create($data);

        return response()->json(['status' => 200]);
    }
}

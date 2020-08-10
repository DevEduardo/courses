<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Student;
use App\StudentCourse;
use Illuminate\Http\Request;

class CoursePostController extends Controller
{
    public function __invoke(Request $reuqest)
    {
        foreach ($reuqest->coursesChecked as $course) {
            $studentCourse = new StudentCourse();
            $studentCourse->student_id = $reuqest->student;
            $studentCourse->course_id = $course;
            $studentCourse->save();
        }

        $studentCourses = StudentCourse::with('courses')->where('student_id', $reuqest->student)->get();
        return response()->json([
            'status' => 200,
            'data' => $studentCourses
        ]);
    }
}

<?php

namespace App\Http\Controllers\Student;

use App\Course;
use App\Http\Controllers\Controller;
use App\Student;
use App\StudentCourse;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke($id)
    {
        
        $student = Student::find($id);
        $studentCourses = StudentCourse::with('courses')->where('student_id', $id)->get();
        $courses = Course::whereNotIn('id', $this->idCoursesNotStudent($studentCourses))->get();
        return view('student.show', compact('student', 'courses', 'studentCourses'));
    }

    private function idCoursesNotStudent($courses)
    {
        $coursesId = [];
        foreach ($courses as $course) {
            array_push($coursesId, $course->id);
        }
        return $coursesId;
    }
}

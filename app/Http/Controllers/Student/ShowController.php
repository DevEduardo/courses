<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke($id)
    {
        $student = Student::find($id);
        return view('student.show', compact('student'));
    }
}

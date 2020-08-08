<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __invoke()
    {
        $students = Student::all();

        return view('student.index', compact('students'));
    }
}

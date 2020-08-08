<?php

namespace App\Http\Controllers\Course;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __invoke()
    {
        $courses = Course:: all();
        return view('course.index', compact('courses'));
    }
}

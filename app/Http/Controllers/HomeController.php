<?php

namespace App\Http\Controllers;

use App\StudentCourse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __invoke()
    {
        $date = Carbon::now();
        $endDate = $date->subMonth(6);
        
        $idCourse = StudentCourse::select('id')
            ->whereDate('created_at', '<=', Carbon::now()->format('Y-m-d'))
            ->whereDate('created_at', '>=', Carbon::now()
            ->subMonth(6)->format('Y-m-d'))
            ->get();
        
        $courses = StudentCourse::select(\DB::raw('count(*) as student, course_id'))
            ->whereIn('id', $idCourse->toArray())
            ->groupBy('course_id')->get();
        $courses->load('courses');
        return view('home', compact('courses'));
    }
}

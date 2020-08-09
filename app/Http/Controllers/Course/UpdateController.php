<?php

namespace App\Http\Controllers\Course;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $course = Course::find($id);
        $course->name = $request->name;
        $course->schedule = $request->schedule;
        $course->starDate = $request->starDate;
        $course->endDate = $request->endDate;
        $course->update();
        return response()->json([
            'status' => 200,
            'data' => $course
        ]);
    }
}

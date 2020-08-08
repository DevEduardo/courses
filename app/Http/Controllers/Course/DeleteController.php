<?php

namespace App\Http\Controllers\Course;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke($id)
    {
        $student = Course::find($id);
        $student->delete();
        return redirect('courses');
    }
}

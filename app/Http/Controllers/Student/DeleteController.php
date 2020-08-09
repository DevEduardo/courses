<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke($id)
    {
        $student = Student::find($id);
        $student->delete();
        return response()->json(['status' => 200]);
    }
}

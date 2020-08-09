<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $student = Student::find($id);
        $student->name = $request->name;
        $student->lastName = $request->lastName;
        $student->age = $request->age;
        $student->email = $request->email;
        $student->update();
        return response()->json([
            'status' => 200,
            'data' => $student
        ]);
    }
}

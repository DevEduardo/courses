<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __invoke()
    {
        $data = request()->validate([
            'name' => 'required',
            'lastName' => 'required',
            'age' => 'required',
            'email' => 'required'
        ]);

        Student::create($data);
    }
}

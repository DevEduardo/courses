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
            'name' => 'required|string',
            'lastName' => 'required|string',
            'age' => 'required|string',
            'email' => 'required|email'
        ]);

        Student::create($data);
    }
}

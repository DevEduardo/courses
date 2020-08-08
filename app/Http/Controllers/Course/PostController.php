<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Course;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __invoke()
    {
        $data = request()->validate([
            'name' => 'required|string',
            'schedule' => 'required|string',
            'starDate' => 'required|date',
            'endDate' => 'required|date',
        ]);

        Course::create($data);

        return redirect('courses');
    }
}

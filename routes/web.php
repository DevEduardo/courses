<?php

Route::get('/', 'HomeController');

Route::view('student-create', 'student.create');
Route::post('students', 'Student\PostController');
Route::get('students', 'Student\ListController');
Route::get('students/{student}', 'Student\ShowController');
Route::put('students/{student}', 'Student\UpdateController');
Route::delete('students/{student}', 'Student\DeleteController');
Route::get('student-new-course/{student}', 'Student\CourseController');
Route::post('studentCourse', 'Student\CoursePostController');

Route::view('course-create', 'course.create');
Route::post('courses', 'Course\PostController');
Route::get('courses', 'Course\ListController');
Route::get('courses/{course}', 'Course\ShowController');
Route::put('courses/{course}', 'Course\UpdateController');
Route::delete('courses/{course}', 'Course\DeleteController');

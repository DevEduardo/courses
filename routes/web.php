<?php

Route::post('students', 'Student\PostController');
Route::get('students', 'Student\ListController');
Route::get('students/{student}', 'Student\ShowController');

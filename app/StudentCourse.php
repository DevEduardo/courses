<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $guarded = [];

    public function courses() {
        return $this->belongsTo('App\Course', 'course_id', 'id');
    }

    public function students() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }
}

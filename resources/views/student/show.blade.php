@extends('welcome')

@section('content')
    <student-show
        :studying = "{{ json_encode($studentCourses) }}"
        :student = "{{ json_encode($student) }}"
        :courses = "{{ json_encode($courses) }}"
    >
    </student-show>
@endsection
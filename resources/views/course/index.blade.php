@extends('welcome')

@section('content')
    <course-list
        :courses = "{{ json_encode($courses) }}"
    >
    </course-list>
@endsection
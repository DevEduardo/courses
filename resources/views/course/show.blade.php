@extends('welcome')

@section('content')
    <course-show
        :course = "{{ json_encode($course) }}"
    >
    </course-show>
@endsection
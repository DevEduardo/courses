@extends('welcome')

@section('content')
    <student-show
        :student = "{{ json_encode($student) }}"
    >
    </student-show>
@endsection
@extends('welcome')

@section('content')
    <student-list
        :students = "{{ json_encode($students) }}"
    >
    </student-list>
@endsection
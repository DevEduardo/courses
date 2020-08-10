@extends('welcome')

@section('content')
    <home
        :courses = "{{ json_encode($courses) }}"
    ></home>
@endsection
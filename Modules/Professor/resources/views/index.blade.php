@extends('professor::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('professor.name') !!}</p>
@endsection

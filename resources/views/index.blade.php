@extends('layouts.master')

@section('title')
    Laravel
@stop

@section('content')

@guest
    <h2>Public resources</h2>
    <p>
        <a href="{{ url('organisations') }}">Organisations list</a>
    </p>
    <h2>Admin resources</h2>
    <p>
        <a href="{{ route('login') }}">{{ __('Login') }}</a> or
        <a href="{{ route('register') }}">{{ __('Register') }}</a>
    </p>
@else
    <h2>Admin resources</h2>
    <p>
        <a href="{{ url('organisations') }}">Organisations list</a>
    </p>
    <p>
        <a href="{{ url('import/organisations')}}">Import organisations</a>
    </p>
@endguest


@stop

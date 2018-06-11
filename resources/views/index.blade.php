@extends('layouts.master')

@section('title')
    Laravel
@stop

@section('content')

<h2>Resources</h2>

<p><a href="{{ url('organisations') }}">Organisations list</a></p>

@auth
    <h2>Admin</h2>

    <p>
        <a href="{{ url('import/organisations')}}">Import organisations</a>
    </p>
@endauth


@stop

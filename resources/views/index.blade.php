@extends('layouts.master')

@section('title')
    Laravel
@stop

@section('content')

<h2>Resources</h2>

<p><a href="{{ url('organisations') }}">Organisations</a></p>

<h2>Admin</h2>

<p>
    <a href="{{ url('organisations/import')}}">Import organisations</a>
</p>

@stop

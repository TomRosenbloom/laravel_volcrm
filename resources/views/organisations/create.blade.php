@extends('layouts.master')

@section('title')
    Add organisation
@endsection


@section('content')

    <h1>Add organisation</h1>

    {!! Form::open(['action' => 'OrganisationController@store', 'method' => 'POST']) !!}
        @include('organisations.form')
    {!! Form::close() !!}

@endsection

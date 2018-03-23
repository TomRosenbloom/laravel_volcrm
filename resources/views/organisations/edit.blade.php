@extends('layouts.master')

@section('title')
    Organisation edit
@endsection


@section('content')

    <h1>Edit organisation</h1>

    {!! Form::model($organisation,['action' => ['OrganisationController@update', $organisation->id], 'method' => 'POST']) !!}
        @include('organisations.form')
        {{Form::hidden('_method','PUT')}}
    {!! Form::close() !!}

@endsection

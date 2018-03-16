@extends('layouts.master')

@section('title')
    Organisation edit
@endsection


@section('mainContent')

    <h1>Edit organisation</h1>

    {!! Form::open(['action' => ['OrganisationController@update', $organisation->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $organisation->name, ['class'=>'form-control', 'placeholder'=>'Organisation'])}}
        </div>
        <div class="form-group">
            {{Form::label('aims_and_activities', 'Aims and activities')}}
            {{Form::textarea('aims_and_activities', $organisation->aims_and_activities, [
                'id'=>'article-ckeditor',
                'class'=>'form-control',
                'placeholder'=>'Aims and activities'
                ])}}
        </div>
        <div class="form-group">
            {{Form::label('postcode', 'Postcode')}}
            {{Form::text('postcode', $organisation->postcode, ['class'=>'form-control', 'placeholder'=>'Postcode'])}}
        </div>
        <div class="form-group">
            {{Form::label('telephone', 'Telephone')}}
            {{Form::text('telephone', $organisation->telephone, ['class'=>'form-control', 'placeholder'=>'Telephone'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::text('email', $organisation->email, ['class'=>'form-control', 'placeholder'=>'Email'])}}
        </div>
        <div class="form-group">
            {{Form::label('income_band_id', 'Income band')}}
            {{Form::select('income_band_id', $income_bands, $organisation->income_band_id)}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection

@extends('master')

@section('title')
    Add organisation
@endsection


@section('mainContent')

    <h1>Add organisation</h1>

    {!! Form::open(['action' => 'OrganisationController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class'=>'form-control', 'placeholder'=>'Organisation'])}}
        </div>
        <div class="form-group">
            {{Form::label('aims_and_activities', 'Aims and activities')}}
            {{Form::textarea('aims_and_activities', '', [
                'id'=>'article-ckeditor',
                'class'=>'form-control',
                'placeholder'=>'Aims and activities'
                ])}}
        </div>
        <div class="form-group">
            {{Form::label('postcode', 'Postcode')}}
            {{Form::text('postcode', '', ['class'=>'form-control', 'placeholder'=>'Postcode'])}}
        </div>
        <div class="form-group">
            {{Form::label('telephone', 'Telephone')}}
            {{Form::text('telephone', '', ['class'=>'form-control', 'placeholder'=>'Telephone'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::text('email', '', ['class'=>'form-control', 'placeholder'=>'Email'])}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection

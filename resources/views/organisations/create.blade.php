@extends('layouts.master')

@section('title')
    Add organisation
@endsection


@section('content')

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
        <div class="form-row">
            <div class="form-group col-md-2">
                {{Form::label('postcode', 'Postcode')}}
                {{Form::text('postcode', '', ['class'=>'form-control', 'placeholder'=>'Postcode'])}}
            </div>
            <div class="form-group col-md-4">
                {{Form::label('telephone', 'Telephone')}}
                {{Form::text('telephone', '', ['class'=>'form-control', 'placeholder'=>'Telephone'])}}
            </div>
            <div class="form-group col-md-4">
                {{Form::label('email', 'Email')}}
                {{Form::text('email', '', ['class'=>'form-control', 'placeholder'=>'Email'])}}
            </div>
        </div>
        <div class="row form-group">
            <div class="col-3">
                {{Form::label('income_band_id', 'Income band')}}
                {{Form::select('income_band_id', $income_bands, '6', ['class'=>'form-control'])}}
            </div>
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection

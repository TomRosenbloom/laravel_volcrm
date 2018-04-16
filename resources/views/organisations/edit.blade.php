@extends('layouts.master')

@section('title')
    Organisation edit
@endsection


@section('content')

    <h1>Edit organisation</h1>

    {!! Form::model($organisation,['action' => ['OrganisationController@update', $organisation->id], 'method' => 'POST']) !!}
        @include('organisations._form')
        {{Form::hidden('_method','PUT')}}
    {!! Form::close() !!}

@endsection

@section('scripts')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'article-ckeditor', {
        customConfig: '/vendor/unisharp/laravel-ckeditor/my_config.js'
    });
</script>
@endsection

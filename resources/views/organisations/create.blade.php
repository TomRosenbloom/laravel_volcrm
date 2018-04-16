@extends('layouts.master')

@section('title')
    Add organisation
@endsection


@section('content')

    <h1>Add organisation</h1>

    {!! Form::open(['action' => 'OrganisationController@store', 'method' => 'POST']) !!}
        @include('organisations._form')
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

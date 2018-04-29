@extends('layouts.master')

@section('title')
    foo
@stop

@section('content')
    <h1>Import Organisations</h1>

    <form action="{{url('organisations/import')}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <input type="file" class="form-control" name="imported-file"/>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit">Import</button>
      </div>
    </form>

@stop

@extends('layouts.master')

@section('title')
    List of organisations
@endsection


@section('content')

    <h1>Organisations</h1>

    @auth
    <p>
        <a href="/organisations/create">Add organisation</a>
    </p>
    @endauth

    {!! Form::open(['action' => 'OrganisationController@index', 'method' => 'GET', 'class' => 'form-inline']) !!}
        {{Form::label('num_items', 'Show')}}
        {{Form::Select('num_items', [4=>4,6=>6,10=>10,50=>50], $num_items, ['class'=>'form-control-sm ml-1'])}}
        {{Form::submit('Go', ['class'=>'btn btn-outline-primary btn-sm ml-1'])}}
    {!! Form::close() !!}


    @if(count($organisations) > 0)
        @foreach($organisations as $organisation)
            <div class="well">
                <h3><a href="/organisations/{{$organisation->id}}">{{$organisation->order_name}}</a></h3>
            </div>
        @endforeach
        {{$organisations->links()}}
    @else
        <p>
            No organistions found
        </p>
    @endif

@endsection

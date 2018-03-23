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

    @if(count($organisations) > 0)
        @foreach($organisations as $organisation)
            <div class="well">
                <h3><a href="/organisations/{{$organisation->id}}">{{$organisation->name}}</a></h3>
            </div>
        @endforeach
        {{$organisations->links()}}
    @else
        <p>
            No organistions found
        </p>
    @endif

@endsection

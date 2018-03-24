@extends('layouts.master')

@section('title')
    Organisation show
@endsection


@section('content')

    <div class="card" style="margin-top:50px">

        <div class="card-header">
            <div class="row">
                <div class="col-sm-9">
                    <h2 class="card-title">{{$organisation->name}}</h2>
                </div>
                <div class="col-sm-3">
                    <i class="fa fa-external-link"></i>
                    <i class="fa fa-envelope-o"></i>
                    <i class="fa fa-facebook"></i>
                    <a href="#" class="fa fa-twitter"></a>
                </div>
            </div>
        </div>

        <div class="card-body">

            <dl class="row">
                <dt class="col-sm-2">
                Aims and activities
                </dt>
                <dd class="col-sm-10">
                {!!$organisation->aims_and_activities!!}
                </dd>
                <dt class="col-sm-2">
                Address
                </dt>
                <dd class="col-sm-10">
                {{$address->line_1}}
                </dd>
                <dt class="col-sm-2">
                &nbsp;
                </dt>
                <dd class="col-sm-10">
                {{$address->city}}
                </dd>
                <dt class="col-sm-2">
                Postcode
                </dt>
                <dd class="col-sm-10">
                {{$address->postcode}}
                </dd>
                <dt class="col-sm-2">
                Tel.
                </dt>
                <dd class="col-sm-10">
                {{$organisation->telephone}}
                </dd>
                <dt class="col-sm-2">
                Email
                </dt>
                <dd class="col-sm-10">
                {{$organisation->email}}
                </dd>
            </dl>

            @if(!Auth::guest())
            <p>
                <a href="/organisations/{{$organisation->id}}/edit">Edit this organisation</a>
            </p>

            {!!Form::open(['action' => ['OrganisationController@destroy', $organisation->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
            @endif

        </div>

    </div>

@endsection

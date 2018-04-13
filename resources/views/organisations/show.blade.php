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

            <div class="collapse" id="collapseExample">
                <dl class="row">
                    <dt class="col-sm-2">Income</dt>
                    <dd class="col-sm-10">
                        {!!$organisation->income_band->textual!!}
                    </dd>
                    <dt class="col-sm-2">Type(s)</dt>
                    <dd class="col-sm-10">
                        @foreach($organisation->organisation_types as $type)
                            {{$type->name}} {{$type->pivot->reg_num}}<br />
                        @endforeach
                    </dd>
                </dl>
            </div>


            <div class="form-row mb-3">
                <div class="col-4">
                    <a data-toggle="collapse" class="collapsed text-secondary" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                      <i class="fa" aria-hidden="true"></i>
                      <span>

                      </span>
                    </a>
                </div>
            </div>


            @if(!Auth::guest())

            <div class="form-row">
                <div class="col-1">
                    {!!Form::open(['action' => ['OrganisationController@edit', $organisation->id], 'method' => 'GET'])!!}
                        {{Form::submit('Edit',['class' => 'btn btn-primary btn-block'])}}
                    {!!Form::close()!!}
                </div>

                <div class="col-1">
                    {!!Form::open(['action' => ['OrganisationController@destroy', $organisation->id], 'method' => 'POST', 'onsubmit' => 'return confirm("Really delete?")'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                </div>
            </div>

            @endif

        </div>

    </div>

@endsection

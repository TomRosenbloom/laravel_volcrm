@extends('layouts.master')

@section('title')
    Laravel
@stop

@section('content')

    <h1>About this demo app</h1>
    <p>
        This is a demo application that I'm making to develop and showcase my knowledge of Laravel and related technologies
    </p>
    <p>
        There is currently a simple two-level access control - Public and Admin.
        For the purposes of demonstration anyone can sign-up as an admin and add, edit and delete data.
    </p>
    <p>
        Any registrations, logins and data changes are logged and emailed to me in case anyone decides to trash the place.
    </p>


@stop

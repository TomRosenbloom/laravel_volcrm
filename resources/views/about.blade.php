@extends('layouts.master')

@section('title')
    Laravel
@stop

@section('content')

<div class="w-75">
    <h1>About this demo app</h1>
    <h2>Intro</h2>
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
    <p>
        The use case is a CRM and volunteer matching system for the voluntary sector. The core is a database of organisations
        offering voluntary roles (or doing other work in the sector). Public users can browse the database,
        admin users can add, edit and delete organisations.
    </p>
    <p>
        Ultimately, the plan is that people will be able to
        <ul>
            <li>Register as a volunteer, create a profile and then search
            for roles and receive automated alerts</li>
            <li>Register as an organisational user, and then create and manage an organisation/its voluntary roles</li>
        </ul>
    </p>
    <h2>Features</h2>
    <h3>CRUD for organisations</h3>
    <p></p>    
</div>

@stop

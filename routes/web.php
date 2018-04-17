<?php

Route::get('/', function () {
    return view('index');
});

Route::resource('organisations', 'OrganisationController');

// this should really be in API routes...?
Route::get('organisation_search/{search_terms}', 'OrganisationController@liveSearch');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

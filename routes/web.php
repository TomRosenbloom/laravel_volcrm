<?php

Route::get('/', function () {
    return view('index');
});

Route::resource('organisations', 'OrganisationController');
//Route::get('organisations/{id}/page/{page}', 'OrganisationController@show');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

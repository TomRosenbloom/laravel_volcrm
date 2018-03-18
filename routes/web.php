<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::resource('organisations', 'OrganisationController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

/*
should a 'directory' - i.e. the public interface - be part of the same app. or
completely separate?
I guess that depends on shared components. You wouldn't want to have any models
in the directory that also exist in the CRM. So how would that even work? Do you
need MVC for something that is read only? Would a directory really be completely
read only? Should the directory part use an API? Single page app?
 */

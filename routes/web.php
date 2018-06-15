<?php
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\Helpers\Postcode;


// authentication routes
Auth::routes();

// static routes
Route::get('/', function () {
    return view('index');
});
Route::get('/about', function () {
    return view('about');
});

// organisation crud routes
Route::resource('organisations', 'OrganisationController');

// routes for Laravel-Excel import
Route::get('import/organisations', 'ImportController@org_form');
Route::post('import/organisations', 'ImportController@organisations');

// route for search
// this should really be in API routes...?
Route::get('organisation_search/{search_terms}', 'OrganisationController@liveSearch');


// postcode/address related
Route::get('foo', function(){
    $client = new Client(); //GuzzleHttp\Client
    $response = $client->get('http://maps.googleapis.com/maps/api/geocode/json', [
        'query' => ['address' => 'EX4 2LG']
    ]);
    var_dump($response->getBody()->getContents());
});
Route::get('bar', function(){
    $postcode = new Postcode('EX4 2LG');
    echo $postcode->getAddr();
});

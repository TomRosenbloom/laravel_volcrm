<?php
// here trying to do 'get address(es) from postcode' with a helper
// Probably this is not the best way, and I should be using a facade, or a provider, who knows...
// ...let's try this for now

namespace App\Helpers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Postcode
{
    private $apiUrl;
    private $client;

    protected $lat;
    protected $lng;

    public function __construct($postcode)
    {
        $this->apiUrl = 'https://maps.googleapis.com/maps/api/geocode/json';
        $this->client = new Client(); //GuzzleHttp\Client
        $this->getLatLong($postcode);
    }

    private function getLatLong($postcode)
    {
        $response = $this->client->get($this->apiUrl, [
            'query' => ['address' => 'EX4 2LG', 'key' => 'AIzaSyBdOHfTtc9JrepVnRoKGvzeRQ4Q3KZbSgE']
        ]);

        //echo($response->getStatusCode());

        $jsonString = $response->getBody()->getContents();

        //var_dump($jsonString);

        $this->lat = json_decode($jsonString)->results[0]->geometry->location->lat;
        $this->lng = json_decode($jsonString)->results[0]->geometry->location->lng;

        // return [$this->lat, $this->lng]; // lat 50.73995540000001 long -3.602318699999999
    }

    public function getAddr()
    {

// obviously enough you don't get all the addresses in the postcode from the lat/long (duh)
// so in fact I can't use google maps to get addresses in a post code
// I was able to use it in my Python version to get postcodes withn n miles of another postcode
// but that's different
// Seems the only way to get addresses from postcodes is to pay some cunt

        $response = $this->client->get($this->apiUrl, [
            'query' => ['latlng' => $this->lat . ',' . $this->lng, 'key' => 'AIzaSyBdOHfTtc9JrepVnRoKGvzeRQ4Q3KZbSgE']
        ]);

        $jsonString = $response->getBody()->getContents();

        echo "<pre>"; var_dump($jsonString); echo "</pre>";

        foreach(json_decode($jsonString)->results as $result){
            echo $result->formatted_address . "<br />";
        }
    }
}

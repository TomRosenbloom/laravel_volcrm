<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function organisations()
    {
        return $this->belongsToMany('App\Organisation', 'organisation_address');
    }
}

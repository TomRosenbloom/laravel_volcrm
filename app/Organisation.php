<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function income_band(){
        return $this->belongsTo('App\IncomeBand');
    }

    public function addresses()
    {
        return $this->belongsToMany('App\Address', 'organisation_addresses')->withPivot('is_default','address_type_id');
    }

    public function getDefaultAddress()
    {
        return $this->belongsToMany('App\Address', 'organisation_addresses')->wherePivot('is_default',1);        
    }
}

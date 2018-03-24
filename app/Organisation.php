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
        return $this->belongsToMany('App\Address', 'organisation_address')->withPivot('is_default','address_type_id');
    }

    /**
     * return the address flagged as default
     * there should only be one default address (where can I enforce this?), so
     * using 'first' should work
     *
     * @return [type] [description]
     */
    public function getDefaultAddress()
    {
        return $this->belongsToMany('App\Address', 'organisation_address')->wherePivot('is_default',1)->first();
    }
}

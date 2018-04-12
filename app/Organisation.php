<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Address;

class Organisation extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function income_band(){
        return $this->belongsTo('App\IncomeBand');
    }

    // organisation can have more than one type (with optional associated reg number)
    public function organisation_types(){
        return $this->belongsToMany('App\OrganisationType', 'organisation_type')->withPivot('reg_num');
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
     * @return Address default address for organisation
     */
    public function getDefaultAddress()
    {
        $address = $this->belongsToMany('App\Address', 'organisation_address')->wherePivot('is_default',1)->first();
        if ($address == ''){
            $address = new Address;
        }
        return $address;
    }
}

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

}

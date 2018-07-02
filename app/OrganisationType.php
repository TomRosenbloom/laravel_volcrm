<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganisationType extends Model
{
    public function organisations(){
        return $this->hasMany('App\Organisation');
    }

    public static function getAll(){
        return self::all();
    }
}

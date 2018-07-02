<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * define relationship with address model
     *
     * @return [type] [description]
     */
    public function addresses(){
        return $this->hasMany('App\Address');
    }

    public static function getForSelect(){
        return self::pluck('name','id')->toArray();
    }
}

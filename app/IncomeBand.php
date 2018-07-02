<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeBand extends Model
{
    public function organisations(){
        return $this->hasMany('App\Organisation');
    }

    public static function getForSelect(){
        return self::all()->pluck('textual');
    }
}

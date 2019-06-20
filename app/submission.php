<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class submission extends Model
{

public function analysis()
{
    return $this->hasMany('App\analysis');
}


    public function login()
    {
        return $this->belongsTo('App\User');
    }


}

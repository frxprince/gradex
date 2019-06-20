<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    public function User()
    {
        return $this->hasMany('App\User');
    }
    public function classname()
    {
        return $this->hasOne('App\classname');
    }
}

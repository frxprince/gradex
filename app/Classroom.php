<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function classname()
    {
        return $this->hasOne('App\Classname');
    }
    public function users()
    {
        return $this->hasMany('App\User');
    }
}

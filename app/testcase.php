<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class testcase extends Model
{
    public function analysis()
    {
        return $this->hasMany('App\analysis');
    }
}

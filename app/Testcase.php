<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testcase extends Model
{
    public function problem()
    {
        return $this->belongsTo('App\Problem', 'id', 'problem_id');
    }
    public function analyses()
    {
        return $this->hasMany('App\Analysis', 'testcase_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Problem;
use App\Course;
class Schedule extends Model
{
    public function problems()
    {
        return $this->hasMany('App\Problem');
    }
    public function courses()
    {
        return $this->hasMany('App\Course', 'foreign_key', 'local_key');
    }
}

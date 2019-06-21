<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classroom;
class Course extends Model
{
    public $timestamps = false;
    public function classrooms()
    {
        return $this->hasMany('App\Classroom');
    }
    public function schedule()
    {
        return $this->belongsTo('App\Schedule','course_id','id');
    }
   
}

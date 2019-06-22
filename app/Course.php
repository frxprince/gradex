<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classroom;
use App\Schedule;
class Course extends Model
{
    public $timestamps = false;
    public function classrooms()
    {
        return $this->hasMany('App\Classroom','course_id','id');
    }
    public function schedules()
    {
        return $this->belongsTo('App\Schedule','course_id','id');
    }
   
}

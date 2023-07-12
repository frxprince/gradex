<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Problem;
use App\Course;
class Schedule extends Model
{
public function course()
{
    return $this->hasOne('App\Course','id','course_id');
}
public function problem()
{
    return $this->hasOne('App\Problem','id','problem_id');
}
public function submission()
{
    return $this->hasMany('App\Submission', 'id', 'schedule_id');
}
}

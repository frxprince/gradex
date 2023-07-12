<?php

namespace App;
use App\schedule;
use App\User;
use App\Course;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public $timestamps = false;
   
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function course()
    {
        return $this->hasOne('App\Course', 'id', 'course_id');
    }
}

<?php

namespace App;
use App\schedule;
use App\User;
use App\Course;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public $timestamps = false;
    public function schedule()
    {
        return $this->belongsTo('App\Schedule', 'id', 'course_id');
    }
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}

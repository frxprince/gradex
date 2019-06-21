<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public $timestamps = false;
    public function schedule()
    {
        return $this->belongsTo('App\Schedule', 'id', 'course_id');
    }
}

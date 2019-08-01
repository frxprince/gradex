<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Analyses;
class Submission extends Model
{
    public function analyses()
    {
        return $this->hasMany('App\Analyis', 'submission_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function schedule()
    {
        return $this->belongsTo('App\Schedule', 'schedule_id', 'id');
    }

}

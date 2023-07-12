<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waitinglist extends Model
{
    public function submission()
    {
        return $this->hasOne('App\Submission', 'id', 'submission_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    public function testcase()
    {
        return $this->belongsTo('App\testcase', 'id', 'testcase_id');
    }
    public function submission()
    {
        return $this->belongsTo('App\Submission', 'id', 'submission_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class analysis extends Model
{
    public function submission_id()
    {
        return $this->belongsTo('App\submission');
    }
    public function testcase_id()
    {
        return $this->belongsTo('App\testcase');
    }
}

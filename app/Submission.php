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
    
}

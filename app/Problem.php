<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
class Problem extends Model
{
  public function testcases()
  {
      return $this->hasMany('App\Testcase');
  }

  public function schedule()
  {
      return $this->belongsTo('App\Schedule','problem_id','id');
  }
 


}

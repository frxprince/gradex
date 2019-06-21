<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
class Problem extends Model
{
   public function schedule()
   {
       return $this->belongsTo('App\Schedule');
   }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classname extends Model
{
   public function id()
   {
       return $this->belongsTo('App\Classroom');
   }
}

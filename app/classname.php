<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class classname extends Model
{
   public function name()
   {
       return $this->belongsTo('App\group');
   }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class problems extends Model
{
    public function comments()
    {
        return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    }
}

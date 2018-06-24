<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    public function customer()
    {
      return $this->belongsTo('App\Customer');
    }

    public function pettype()
    {
      return $this->belongsTo('App\Pettype');
    }

    public function registers()
    {
      return $this->hasMany('App\Register');
    }
}

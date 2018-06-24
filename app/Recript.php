<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recript extends Model
{
    public function prescription()
    {
      return $this->belongsTo('App\Prescription');
    }
}

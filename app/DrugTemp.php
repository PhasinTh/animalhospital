<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugTemp extends Model
{
    public function drug()
    {
      return $this->belongsTo('App\Drug');
    }
}

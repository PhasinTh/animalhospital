<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    public function drug_temps()
    {
      return $this->belongsTo('App\DrugTemp');
    }
}

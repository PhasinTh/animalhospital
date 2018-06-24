<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
  public function employee()
  {
    return $this->belongsTo('App\Employee');
  }

  public function diagnose()
  {
    return $this->belongsTo('App\Diagnose');
  }

}

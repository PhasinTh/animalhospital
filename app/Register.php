<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
  public function pet()
  {
    return $this->belongsTo('App\Pet');
  }

  public function employee()
  {
    return $this->belongsTo('App\Employee','emp_id','id');
  }

  public function diagnose()
  {
    return $this->hasOne('App\Diagnose');
  }
}

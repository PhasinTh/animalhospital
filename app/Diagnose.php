<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnose extends Model
{
    public function register()
    {
      return $this->belongsTo('App\Register');
    }

    public function appointment()
    {
      return $this->hasOne('App\Appointment');
    }

    public function employee()
    {
      return $this->belongsTo('App\Employee','emp_id','id');
    }

    public function prescription()
    {
      return $this->hasOne('App\Prescription');
    }
}

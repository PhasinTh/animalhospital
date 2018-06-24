<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function register()
    {
      return $this->belongsTo('App\Register');
    }

    public function diagnose()
    {
      return $this->belongsTo('App\Diagnose');
    }

    public function prescriptioneetail()
    {
      return $this->hasMany('App\PrescriptionDetail');
    }
}

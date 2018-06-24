<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrescriptionDetail extends Model
{
    public function drug()
    {
      return $this->belongsTo('App\Drug');
    }
}

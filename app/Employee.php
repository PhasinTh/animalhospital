<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Employee extends Model
{
    protected $table = "users";
    public function workdays()
    {
      return $this->belongsToMany('App\DayofWeek')->withTimestamps();
    }

    public function registers()
    {
      return $this->hasMany('App\Register','emp_id');
      // return "555";
    }

    public function emptype()
    {
      return $this->belongsTo('App\Emptype','emptypeId','id');
    }

    public function diagnoses()
    {
      return $this->hasMany('App\Diagnose');
    }

    public function isOnline()
    {
      return Cache::has('user-is-online-'. $this->id);
    }
}

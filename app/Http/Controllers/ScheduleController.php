<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DayofWeek;
use App\Employee;
class ScheduleController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      // dd();
      return view('schedule.index')->withDayofweek(DayofWeek::get());
    }
}

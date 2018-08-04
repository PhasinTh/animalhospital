<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pet;
use App\Pettype;
use App\Emptype;
use App\Employee;
use App\Register;
use App\Recript;
use App\Prescription;
use App\Appointment;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pettypes = Pettype::all();
      $types = array();
      foreach ($pettypes as $pettype) {
        $types[$pettype->id] = $pettype->name;
      }

      $emptype1 = Emptype::where('name','สัตวแพทย์')->first();
      $veterinary = Employee::where('emptypeId',$emptype1->id)->count();
      $queue = Register::where('status', 'ส่งตรวจ')->count();
      $prescription = Prescription::where('status', 'รอ')->count();
      $receiption = Recript::where('status','รอ')->count();
      $appointment = Appointment::whereDay('date', '=',date('d'))->count();
      $stats = new class{};
      $stats->veterinary = $appointment;
      $stats->queue = $queue;
      $stats->prescription = $prescription;
      $stats->receiption = $receiption;


      return view('home')->withPettypes($types)->withStats($stats);
    }
}

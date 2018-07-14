<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Drug;
use App\Pet;
use App\DrugTemp;
use App\Employee;
use App\Emptype;
use App\Register;
use App\Appointment;
use App\Prescription;
use App\Pettype;
use App\User;
use App\Diagnose;
use Session;

class ApiDrugController extends Controller
{
  public function getDrug($id)
  {
    return response()->json(Drug::find($id));
  }

  public function getDrugs()
  {
    return response()->json(Drug::where('drugtype_id',1)->get());
  }

  public function getCharge()
  {
    return response()->json(Drug::where('drugtype_id',2)->get());
  }
}

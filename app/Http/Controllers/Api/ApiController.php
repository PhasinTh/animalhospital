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
use Carbon\Carbon;
use Session;


class ApiController extends Controller
{
    private $session;

    // api get pets in database for ajax
    public function getPets()
    {
      $pets = Pet::with('pettype')->with('customer')->withCount(['registers'=>function ($query) {
        $query->where('status', 'ส่งตรวจ');
      }])->orderBy('id','desc')->get();

      // if($pets)
      return response()->json($pets);
    }

    public function savepettype(Request $request)
    {
      $pettype = new Pettype;
      $pettype->name = $request->input("name");
      $pettype->save();
      return "success";
    }


    // api get real-time stats in home page
    public function getStats()
    {
      $emptype1 = Emptype::where('name','สัตวแพทย์')->first();
      $emptype2 = Emptype::where('name','พนักงานบริการ')->first();
      $veterinary = Employee::where('emptypeId',$emptype1->id)->count();
      $service = Employee::where('emptypeId',$emptype2->id)->count();
      $queue = Register::where('status', 'ส่งตรวจ')->count();
      $prescription = Prescription::where('status', 'รอ')->count();
      return response()->json(["veterinary"=>$veterinary,"service"=>$service,"queue"=>$queue,"prescription"=>$prescription]);
    }

    public function getAppointments()
    {
      $data = [];
      $apps = Appointment::orderBy('date','desc')->get();
      foreach ($apps as $key => $value) {
        $temp = [];
        array_push($data,(object)["appointment"=>$value,"diagnose"=>$value->diagnose,"employee"=>$value->employee,"pet"=>$value->diagnose->register->pet,"customer"=>$value->diagnose->register->pet->customer,"pettype"=>$value->diagnose->register->pet->pettype]);
      }
      // dd($data);
      return response()->json($data);
    }

    public function inroom()
    {
      $users = User::all();
      $arruser = [];
      foreach ($users as $key => $value) {
        if($value->isOnline())
          array_push($arruser,$value);
      }
      return response()->json($users);
    }

    public function getprescription($id)
    {
      $diagnose = Diagnose::find($id);
      $temps = $diagnose->prescription->prescriptioneetail();
      if($temps)
        return response()->json($temps->with('drug')->get());
    }


    // Api for Register
    public function register(Request $request)
    {
      $app = Appointment::find($request->input('appid'));
      $app->status = "สำเร็จ";
      $app->save();

      $register = new Register;
      $register->emp_id = $request->input('docid');
      $register->pet_id = $request->input('petid');
      $register->status = "ส่งตรวจ";
      $register->save();
      return "suscess";
    }

    public function getRegister($id)
    {
      $pet = Pet::find($id);
      $temp = [];
      foreach ($pet->registers as $key => $value) {
        if($value->diagnose)
        array_push($temp,(object)["register"=>$value,"pet"=>$value->pet,"customer"=>$value->pet->customer,"diagnose"=>$value->diagnose,"veterinary"=>$value->diagnose->employee]);
      }
      return response()->json($temp);
    }

    public function getChart($number)
    {
      $mont = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
      $pettypes = Pettype::all();
      $data = [];
      foreach ($pettypes as $pettype => $value) {
        $temp = [];
        $now = Carbon::now();
        for ($i=0; $i < $number; $i++) {
          $permonth = 0;
          $temnow = clone $now;
          foreach ($value->pets as $pet) {
            $upperbound = clone $temnow;
            $permonth += $pet->registers->where('created_at','>=',$upperbound->subMonth(1))->where('created_at','<=',$now)->count();
          }
            array_push($temp,["label"=>  $mont[($now->format('m')-1) + 12 % 12].' '.$now->year,"y"=>$permonth]);
          $now->subMonth(1);
        }
        if($temp)
          array_push($data,(object)["type"=>"column","name"=>$value->name,"indexLabel" => "{y}","yValueFormatString"=> "##,###","showInLegend" => true,"dataPoints"=>$temp]);
      }

      return response()->json($data);
    }


}

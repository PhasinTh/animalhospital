<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pettype;
use Carbon\Carbon;
class DaillyChart extends Controller
{
    public function index(){
      $mont = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
      $pettypes = Pettype::all();
      $data = [];
      foreach ($pettypes as $pettype => $value) {
        $temp = [];
        $now = Carbon::now();
        for ($i=0; $i < 6; $i++) {
          $permonth = $value->pets->where('created_at','<=',$now);
          $pet = $permonth->count();
          if($pet)
            array_push($temp,["label"=>  $now->day.' '.$mont[($now->format('m')-1)].' '.$now->year,"y"=>$pet]);
          $now->subWeek(1);
        }
        if($temp)
          array_push($data,(object)["type"=>"column","name"=>$value->name,"indexLabel" => "{y}","yValueFormatString"=> "##,###","showInLegend" => true,"dataPoints"=>$temp]);



      }
      // dd($data);
      // dd(json_encode($data));
      return view('dailychart.index')->withData($data);
    }
}

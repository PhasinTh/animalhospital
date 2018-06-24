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
        for ($i=0; $i < 6; $i++) {
          $permonth = $value->pets->where('created_at','<=',Carbon::now()->subMonth($i));
          $pet = $permonth->count();
          if($pet > 0)
            array_push($temp,["label"=>  $mont[(((Carbon::now()->format('m')-1) - $i)+11) % 11 ] ,"y"=>$pet]);
        }
        if($temp)
          array_push($data,(object)["type"=>"column","name"=>$value->name,"indexLabel" => "{y}","yValueFormatString"=> "##,###","showInLegend" => true,"dataPoints"=>$temp]);

      }
      // dd($data);
      // dd(json_encode($data));
      return view('dailychart.index')->withData($data);
    }
}

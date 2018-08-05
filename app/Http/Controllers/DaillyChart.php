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
      $data2 = [];
      $temp2 = [];
      foreach ($pettypes as $pettype => $value) {
        $temp = [];
        $now = Carbon::now();
        $perday = $value->pets->where('created_at','>', Carbon::now()->subDay(1));
        $pets = 0;
        foreach ($value->pets as $pet) {
          $pets += $pet->registers->where('created_at','>',Carbon::now()->subDay(1))->count();
        }
        if($pets > 0)
          array_push($temp2,(object)["label"=>$value->name,"y"=>$pets]);

        for ($i=0; $i < 1; $i++) {
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

      if($temp2)
        array_push($data2,(object)["type"=>"bar","dataPoints"=>$temp2]);

        // dd($data);

      return view('dailychart.index')->withData($data)->withData2($data2);
    }
}

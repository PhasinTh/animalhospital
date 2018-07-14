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

class ApiTempController extends Controller
{
  // api for DrugTemp
      public function addTemp(Request $request)
      {
        $id = $request->input('id');
        $qty = $request->input('qty');
        $uid = $request->input('uid');
        // $drugtemp = Session::get('drugtemp');
        // $temp = (object)["drug_id"=>$id,"quantity"=>$qty];
        // array_push($drugtemp,$temp);
        // Session::put("drugtemp",$drugtemp);
        // Session::put("test","test");
        // $this->session = Session::put(['test'=>'555']);
        if(DrugTemp::where('emp_id', $uid)->where('drug_id', $id)->count() > 0){
          $drugtemp = DrugTemp::where('drug_id', $id)->first();
          // $drugtemp->drug_id = $id;
          if($qty){
            if($qty > 0)
              $drugtemp->quantity  =  $qty;
            else {
              $drugtemp->quantity  =  $drugtemp->quantity  + $qty;
              if($drugtemp->quantity == 0){
                $drugtemp->delete();
                return "success";
              }
            }
          }
          else {
            $drugtemp->quantity  =  $drugtemp->quantity + 1;
          }
          $drugtemp->emp_id = $uid;
          $drugtemp->save();
        }else{
          $drugtemp = new DrugTemp;
          $drugtemp->drug_id = $id;
          if($qty>0)
          $drugtemp->quantity  = $qty;
          else {
            $drugtemp->quantity  =  1;
          }
          $drugtemp->emp_id = $uid;
          $drugtemp->save();
        }
        return "success";
      }

      public function getTemp($uid)
      {
        // $drugtemp = Session::get('drugtemp',[]);
        // $data = [];
        // foreach ($drugtemp as $key => $value) {
        //   array_push($data,(object)["drug"=>Drug::find($value->drug_id),"quantity"=>$value->quantity]);
        // }
        return response()->json(DrugTemp::where('emp_id',$uid)->with('drug')->get());
        // ->orderBy('drugtype_id','desc')
        // Session::put('test','test');
        // return response()->json($this->session);
      }

      public function delTemp($id)
      {
        $temp = DrugTemp::where('drug_id', $id)->first();
        if($temp)
        $temp->delete();
        return "success";
      }


      public function clearTemp($uid)
      {
        DrugTemp::where('emp_id',$uid)->truncate();
        return "success";
      }
}

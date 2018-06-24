<?php
  namespace app\Helpers;

  use App\Register;
  use App\Prescription;
  use App\Recript;
  use App\Employee;
  use Illuminate\Support\Facades\Auth;
  class Helpers{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public static function waitingDiagnose(){
      $auth = Auth::user();
      if($auth){
      $count =  Register::where('status', 'ส่งตรวจ')->count();
        return $count;
      }
      return "";
    }

    public static function waitingDrug(){
      $count =  Prescription::where('status', 'รอ')->count();
      return $count;
    }

    public static function randomstyle()
    {
      $color = ["default","success","info","warning"];
      return "btn-".$color[rand(0,sizeof($color)-1)];
    }

    public static function waitingReceipt(){
      $count =  Recript::where('status', 'รอ')->count();
      return $count;
    }

    public static function waitingQueue()
    {
      $doctor = Employee::where('emptypeId', '2')->withCount(['registers'=>function ($query) {
        return $query->where('status','ส่งตรวจ');
      }])->get();

      $temp = [];
      foreach ($doctor as $key => $value) {
        if($value->isOnline()){
          array_push($temp,$value);
        }
      }
      return $temp;
    }


    public static function myQueue(){
      $auth = Auth::user();
      if($auth){
      $register =  Register::where('status', 'ส่งตรวจ')->where('emp_id',$auth->id)->get();
        return $register;
      }
      return "";
    }


  }

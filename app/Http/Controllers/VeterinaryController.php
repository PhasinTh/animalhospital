<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests;

use App\Emptype;
use App\Employee;
use App\DayofWeek;

use Illuminate\Support\Facades\Hash;

use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
class VeterinaryController extends Controller
{
    private $url;
    private $title;
    private $empid;

    public function __construct()
    {
      $url = Route::currentRouteName();
      $index = strpos($url,".");
      $url = substr($url,0,$index);

      $this->url = $url;
      if($url == "veterinary"){
        $this->title = "ข้อมูลสัตว์แพทย์";
        $this->id = 2;
      }elseif ($url == "service") {
        $this->title = "ข้อมูลพนักงานบริการ";
        $this->id = 1;
      }elseif ($url == "finance") {
        $this->title ="ข้อมูลฝ่ายการเงิน";
        $this->id = 3;
      }



    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $veterinaries = Employee::where('emptypeID', $this->id)->with('workdays')->get();
        // $workday = $veterinaries[0]->workdays;
        return view('veterinary.index')->withVeterinaries($veterinaries)->withTitle($this->title)->withUrl($this->url);
        // dd($workday);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $emptypes = Emptype::all();
      $dayofweeks = DayofWeek::all();

      $empt = array();
      foreach ($emptypes as $emptype) {
        $empt[$emptype->id] = $emptype->name;
      }

      $days = array();
      foreach ($dayofweeks as $dayofweek) {
        $days[$dayofweek->id] = $dayofweek->name;
      }

      return view('veterinary.create')->withEmptypes($empt)->withDayofweek($days)->withTitle($this->title)->withUrl($this->url);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'name'    =>  'required|max:255',
        'email'  =>  'required|max:100|email|unique:employees',
        'address'  =>  'nullable|max:255',
        'tel'  =>  'nullable|numeric',
        'emptypeId'  =>  'required',
        'password' => 'required|min:6'
      ]);
      //
      $veterinary = new Employee;
      $veterinary->name = $request->input('name');
      $veterinary->email = $request->input('email');
      $veterinary->address = $request->input('address');
      $veterinary->tel = $request->input('tel');
      $veterinary->emptypeId = $request->input('emptypeId');
      $veterinary->password = Hash::make($request->input('password'));
      $veterinary->save();

      $veterinary->workdays()->sync($request->input('dayID'));

      // dd($request->input('dayID'));

      Session::flash("success","บันทึกเรียบร้อย!!!");

      return redirect()->route($this->url.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $veterinary = Employee::find($id);
        return view('veterinary.show')->withVeterinary($veterinary)->withUrl($this->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $emptypes = Emptype::all();
      $dayofweeks = DayofWeek::all();

      $empt = array();
      foreach ($emptypes as $emptype) {
        $empt[$emptype->id] = $emptype->name;
      }

      $days = array();
      foreach ($dayofweeks as $dayofweek) {
        $days[$dayofweek->id] = $dayofweek->name;
      }

        $veterinary = Employee::find($id);
        return view('veterinary.edit')->withEmployee($veterinary)->withEmptypes($empt)->withDayofweek($days)->withTitle($this->title)->withUrl($this->url);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        $request->validate([
          'name'    =>  'required|max:255',
          'email'  =>  'nullable|max:100|email',
          'address'  =>  'nullable|max:255',
          'tel'  =>  'nullable|numeric',
          'emptypeId'  =>  'required'
        ]);
        //
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->address = $request->input('address');
        $employee->tel = $request->input('tel');
        $employee->emptypeId = $request->input('emptypeId');
        $employee->save();

        $employee->workdays()->detach();
        //
        if ($request->input('dayID') != null) {
          $employee->workdays()->sync($request->input('dayID'));
        } else {
          $employee->workdays()->sync(array());
        }

        // dd($request->all());


        Session::flash("success","อัพเดทเรียบร้อย!!!");

        return redirect()->route($this->url.'.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $veterinary = Employee::find($id);
        $veterinary->workdays()->detach();
        $veterinary->delete();

        Session::flash("success","ลบเรียบร้อย!!!");
        return redirect()->route($this->url.'.index');
    }
}

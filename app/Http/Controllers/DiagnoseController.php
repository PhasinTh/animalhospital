<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Register;
use App\Diagnose;
use App\DrugTemp;
use App\Prescription;
use App\PrescriptionDetail;
use App\Appointment;
use Session;
class DiagnoseController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registers = Register::where('status','ส่งตรวจ')->get();
        return view('diagnose.index')->withRegisters($registers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $appointment = $request->input('appointment');
        if($appointment == "นัดหมาย"){
          $request->validate([
            'date' => 'required',
            'detail' => 'required',
          ]);
        }else {
          $request->validate([
            'diagnose' => 'required'
          ]);
        }

        $date = $request->input('date');
        $fixture_time= $request->input('fixture_time');
        $detail = $request->input('detail');
        // dd($request->all());

        $register_id = $request->input('register_id');
        $diagnose = $request->input('diagnose');
        $diagno = new Diagnose ;
        $diagno->emp_id = $request->user()->id;
        $diagno->register_id = $register_id;
        $diagno->diagnose = $diagnose;
        $diagno->save();

        if($appointment == "นัดหมาย"){
          $appointment = new Appointment;
          $appointment->detail = $detail;
          $appointment->employee_id = $request->user()->id;
          $appointment->date = $date." ".$fixture_time;
          $appointment->diagnose_id = $diagno->id;
          $appointment->status = "นัดหมาย";
          $appointment->save();
        }

        $precrip = new Prescription;
        $precrip->diagnose_id = $diagno->id;
        $precrip->status = "รอ";
        $precrip->save();

        $temps = DrugTemp::all();
        foreach ($temps as $temp) {
          $precription = new PrescriptionDetail;
          $precription->prescription_id = $precrip->id;
          $precription->drug_id = $temp->drug_id;
          $precription->quantity = $temp->quantity;
          $precription->save();
        }

        $regis = Register::find($register_id);
        $regis->status = "ตรวจแล้ว";
        $regis->save();
        DrugTemp::truncate();
        Session::flash('success','ทำรายการสำเร็จแล้ว');
        return redirect()->route('diagnose.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $register = Register::find($id);
      return view('diagnose.create')->withRegister($register);
      // dd($register->pet->customer->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSigle($id)
    {
      $registers = Register::where('status','ส่งตรวจ')->where('emp_id',$id)->get();
      return view('diagnose.index')->withRegisters($registers);
    }
}

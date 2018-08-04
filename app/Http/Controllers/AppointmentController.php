<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Employee;
use App\Setting;
use PDF;
use Session;
class AppointmentController extends Controller
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
        $appointments = Appointment::orderBy('created_at','desc')->get();

        return view('appointment.index')->withAppointments($appointments)->withDoctor(Employee::where('emptypeId', 2)->get()->pluck('name','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);
        return view('appointment.show')->withAppointment($appointment)->withSetting(Setting::first());
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
        $app = Appointment::find($id);
        $app->status = "ยกเลิก";
        $app->save();
        Session::flash('success','ลบข้อมูลแล้ว');
        return redirect()->route('appointment.index');

    }

    public function print($id)
    {
      $appointment = Appointment::find($id);
      $pdf = PDF::loadView('appointment.print',['appointment' => $appointment]);
      return $pdf->stream();
    }
}

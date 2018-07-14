<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Recript;
use App\Prescription;
use App\PrescriptionDetail;
use App\Appointment;
use PDF;
use Carbon\Carbon;
use App\Setting;
use App\Drug;
class ReceiptController extends Controller
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
        $receipts = Recript::all();
        // dd($receipts[0]->prescription->id);
        return view('receipt.index')->withReceipts($receipts);
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
        $request->validate([
            'prescription_id' => 'required|unique:recripts'
        ]);

        $prescription_id = $request->input('prescription_id');

        $prescription =  Prescription::find($prescription_id);

        $total = 0;
        foreach ($prescription->prescriptioneetail as $temp) {
          $total += $temp->drug->price * $temp->quantity;
          $drug = Drug::find($temp->drug->id);
          if($drug->drugtype_id == 1)
            $drug->qty = $drug->qty - $temp->quantity;
          $drug->save();
        }

        $receipt = new Recript;
        $receipt->prescription_id = $prescription_id;
        $receipt->employee_id = $request->user()->id;
        $receipt->total = $total;
        $receipt->status = "รอ";
        $receipt->save();

        $prescription->status = "สำเร็จ";
        $prescription->save();

        return redirect()->route('receipt.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $pdf = PDF::loadView('receipt.show');
        // return $pdf->download('invoice.pdf');
        // $appointment = Appointment::find($id);
        // dd($appointment->diagnose);

        $receipt = Recript::find($id);
        $setting = Setting::first();
        // dd($receipt->prescription->diagnose->appointment->date);

        return view('receipt.show')->withReceipt($receipt)->withSetting($setting);
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

    public function save(Request $request)
    {
      $id = $request->input('id');
      $receipt = Recript::find($id);
      $receipt->status = "ชำระแล้ว";
      $receipt->save();
      return response()->json("success");
    }
}

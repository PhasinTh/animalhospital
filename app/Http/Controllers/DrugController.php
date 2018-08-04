<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Session;
use App\Drug;

class DrugController extends Controller
{
  private $drugtype_id;
  private $route;

  public function __construct()
  {
    $this->middleware('auth');
    $url = Route::currentRouteName();
    $index = strpos($url,".");
    $url = substr($url,0,$index);

    $this->route = $url;

    if($url == "drug"){
      $this->drugtype_id = 1;
    }else {
      $this->drugtype_id = 2;
    }

  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugs = Drug::where('drugtype_id', 1)->get();
        $charges = Drug::where('drugtype_id', 2)->get();
        return view('drug.index')->withDrugs($drugs)->withCharges($charges);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->drugtype_id == 2)
          return view('charge.create');
        return view('drug.create');

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
          'drugname'    =>  'required',
          'drugdetail'  =>  'nullable',
          'drugqty'  =>  'nullable|numeric',
          'drugprice'  =>  'required|numeric'
        ]);

        $drug = new Drug;
        $drug->name = $request->input('drugname');
        $drug->description = $request->input('drugdetail');
        if($request->input('drugqty'))
          $drug->qty = $request->input('drugqty');
        else {
          $drug->qty = 1;
        }
        $drug->unit = $request->input('drugunit');
        $drug->price = $request->input('drugprice');
        $drug->drugtype_id = $this->drugtype_id;
        $drug->save();

        Session::flash("success","บันทึกเรียบร้อย!!!");

        return redirect()->route('drug.index');
        // dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $drug = Drug::find($id);
      if($this->route == "charge")
        return view('charge.show')->withDrug($drug);
      return view('drug.show')->withDrug($drug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drug = Drug::find($id);
        if($this->route == "charge")
          return view('charge.edit')->withDrug($drug);

        return view('drug.edit')->withDrug($drug);
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

        $request->validate([
          'name'    =>  'required',
          'description'  =>  'required|nullable',
          'qty'  =>  'required|numeric',
          'price'  =>  'required|numeric'
        ]);

      $drug = Drug::find($id);
      $drug->name = $request->input('name');
      $drug->description = $request->input('description');
      $drug->qty = $request->input('qty');
      $drug->unit = $request->input('unit');
      $drug->price = $request->input('price');
      $drug->save();

      Session::flash("success","อัพเดทเรียบร้อย!!!");

      return redirect()->route('drug.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drug = Drug::find($id);
        $drug->delete();
        Session::flash("success","ลบเรียบร้อย");
        return redirect()->route('drug.index');
    }
}

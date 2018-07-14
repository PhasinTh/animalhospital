<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Pet;
use App\Pettype;
use App\Register;
use Session;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // use api
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->user()->name);
        $request->validate([
          'employee_id' => 'required',
        ]);

        $id = $request->input('pet_id');
        $register = Register::where('pet_id', $id)->first();

        if($register && $register->status == "ส่งตรวจ"){
          $reg = $register;
        }else {
          $reg = new Register;
        }

        $reg->pet_id = $request->input('pet_id');
        $reg->emp_id = $request->input('employee_id');
        $reg->status = "ส่งตรวจ";
        $reg->save();

        Session::flash('success','ส่งตรวจแล้ว');
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
      $pet = Pet::find($id);
      return view('register.show')->withPet($pet);
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
}

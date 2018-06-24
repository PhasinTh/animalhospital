<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Pet;
use App\Pettype;
use App\Register;
use App\Employee;
use App\Emptype;

use Session;
class PetController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth', ['except' => ['create']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pets = Pet::orderBy('created_at','desc')->paginate(10);
        // dd(Register::first()->pet());
        return view('pet.index')->withPets($pets);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $pettypes = Pettype::all();

      $types = array();
      foreach ($pettypes as $pettype) {
        $types[$pettype->id] = $pettype->name;
      }

      return view('pet.create')->withPettypes($types);
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
          "customername"    => "required|max:50",
          "customeremail"   => "nullable|email",
          "customeraddress" => "nullable|max:255",
          "customertel"     => "nullable|numeric",
          "petname"         => "required|max:50",
          "petage"          => "nullable",
          "pettype_id"      => "required|numeric",
          "petspicies"      => "nullable",
          "petsex"          => "in:ผู้,เมีย",
          "petscar"         => "nullable",
          "petallergy"      => "nullable",
        ]);

        $name = Customer::where('name','=' ,$request->input('customername'))->count();
        $email = Customer::where('email','=' ,$request->input('customeremail'))->count();

        if($name > 0 && $email >0){
          $temp = Customer::where('name','=' ,$request->input('customername'))->first();
          // dd($temp->id);
          $customer = Customer::find($temp->id);
        }else{
          $customer = new Customer;
        }

        $customer->name = $request->input('customername');
        $customer->address = $request->input('customeraddress');
        $customer->email = $request->input('customeremail');
        $customer->tel = $request->input('customertel');
        $customer->save();

        $pet = new Pet;
        $pet->name = $request->input('petname');
        $pet->speies = $request->input('petspicies');
        $pet->sex = $request->input('petsex');
        $pet->age = $request->input('petage');
        $pet->scar = $request->input('petscar');
        $pet->allergy = $request->input('petallergy');
        $pet->pettype_id = $request->input('pettype_id');
        $pet->customer_id = $customer->id;
        $pet->save();

        Session::flash('success',"บันทึกเรียบร้อย");
        return redirect()->route('pet.index');

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
      $emptype = Emptype::where('name', 'สัตวแพทย์')->first();
      $veterinaries = Employee::where('emptypeId', $emptype->id)->get();
      $temp = $veterinaries->pluck('name', 'id');
      return view('pet.show')->withPet($pet)->withVeterinaries($temp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $pettypes = Pettype::all();

      $types = array();
      foreach ($pettypes as $pettype) {
        $types[$pettype->id] = $pettype->name;
      }

        $pet = Pet::find($id);
        return view('pet.edit')->withPet($pet)->withPettypes($types);
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
        "customername"    => "required|max:50",
        "customeremail"   => "nullable|email",
        "customeraddress" => "nullable|max:255",
        "customertel"     => "required|numeric",
        "name"         => "required|max:50",
        "age"          => "nullable",
        "type_id"      => "required|numeric",
        "spicies"      => "nullable",
        "sex"          => "in:ผู้,เมีย",
        "scar"         => "nullable",
        "allergy"      => "nullable",
      ]);

      $pet = Pet::find($id);
      $customer = $pet->customer;

      $customer->name = $request->input('customername');
      $customer->address = $request->input('customeraddress');
      $customer->email = $request->input('customeremail');
      $customer->tel = $request->input('customertel');
      $customer->save();

      // $pet = new Pet;
      $pet->name = $request->input('name');
      $pet->speies = $request->input('spicies');
      $pet->sex = $request->input('sex');
      $pet->age = $request->input('age');
      $pet->scar = $request->input('scar');
      $pet->allergy = $request->input('allergy');
      $pet->pettype_id = $request->input('type_id');
      $pet->customer_id = $customer->id;
      $pet->save();
      //
      Session::flash('success',"อัพเดทเรียบร้อย");
      return redirect()->route('pet.index');
      // dd($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pet = Pet::find($id);
        $pet->delete();
        $pet->customer()->delete();
        // Session::flash('success','ลบข้อมูลแล้ว');
        return redirect()->route('pet.index');
    }
}

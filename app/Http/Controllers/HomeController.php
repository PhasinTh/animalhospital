<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pettype;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pettypes = Pettype::all();
      $types = array();
      foreach ($pettypes as $pettype) {
        $types[$pettype->id] = $pettype->name;
      }
      return view('home')->withPettypes($types);
    }
}

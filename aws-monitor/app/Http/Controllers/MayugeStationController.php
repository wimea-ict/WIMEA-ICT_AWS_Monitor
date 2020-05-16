<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class MayugeStationController extends Controller
{
    //
   public function index()
  {

    $data["heading"]="Mayuge Station Reports";

    return view("reports.mayuge",$data);

  }
}

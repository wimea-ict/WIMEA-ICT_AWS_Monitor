<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class EntebbeStationController extends Controller
{
    //
   public function index()
  {

    $data["heading"]="Entebbe Station Reports";

    return view("reports.entebbe",$data);

  }
}

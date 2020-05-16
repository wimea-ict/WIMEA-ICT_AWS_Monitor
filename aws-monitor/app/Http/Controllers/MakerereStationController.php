<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class MakerereStationController extends Controller
{
    //
  public function index()
  {

    $data["heading"]="Makerere Station Reports";

    return view("reports.makerere",$data);

  }    
}

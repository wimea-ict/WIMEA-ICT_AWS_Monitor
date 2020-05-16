<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class KamuliStationController extends Controller
{
    //
   public function index()
  {

    $data["heading"]="Kamuli Station Reports";

    return view("reports.kamuli",$data);

  }
}

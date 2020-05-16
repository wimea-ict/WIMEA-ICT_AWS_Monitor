<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class MubendeStationController extends Controller
{
    //
  public function index()
  {

    $data["heading"]="Mubende Station Reports";

    return view("reports.mubende",$data);

  }
}

<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class JinjaStationController extends Controller
{
    //
   public function index()
  {

    $data["heading"]="Jinja Station Reports";

    return view("reports.jinja",$data);

  }
}

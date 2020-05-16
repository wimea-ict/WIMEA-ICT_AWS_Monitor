<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class LwengoStationController extends Controller
{
    //
   public function index()
  {

    $data["heading"]="Lwengo Station Reports";

    return view("reports.lwengo",$data);

  }
}

<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class BuyendeStationController extends Controller
{
    //
  public function index()
  {

    $data["heading"]="Buyende Station Reports";

    return view("reports.buyende",$data);

  }
}


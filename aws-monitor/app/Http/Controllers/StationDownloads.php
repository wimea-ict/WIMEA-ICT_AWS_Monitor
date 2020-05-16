<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class StationDownloads extends Controller
{
    //
  public function index()
  {

    $data["heading"]="Downloads";

    return view("reports.downloads",$data);

  }
}

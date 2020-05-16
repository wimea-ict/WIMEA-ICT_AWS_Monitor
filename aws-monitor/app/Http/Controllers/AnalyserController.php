<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
 
use DB;

class AnalyserController extends Controller
{
    public function index()
    {
    
$data= DB::select(DB::raw("select * from DetectedAnalyzerProblems inner join stations on DetectedAnalyzerProblems.stationID = stations.station_id where status != 'fixed'"));
   //print_r($data);

   return view('reports/analyser',compact('data'));
     }

}

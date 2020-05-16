<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
 use station\DetectedAnalyzerProblems;
use DB;


class welcomeController extends Controller
{
	 public function index()
    {
    
  $stations_off = DetectedAnalyzerProblems::select('stationID')->where('Problem', '=', 'Station_off')->where('status', '<>','fixed')->get();//->toArray(); 
  $data= DB::table('stations')->select('Latitude','Longitude','Location','station_id')->where('stationCategory','=','aws')->orderBy('station_id', '>=','48')->get();
   //print_r($f);
   //print_r($f);
   return view('auth/welcome',compact('data','stations_off'));
     }

}

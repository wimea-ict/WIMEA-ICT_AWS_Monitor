<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
 
use DB;


class welcomeController extends Controller
{
    public function index()
    {
    
  $data= DB::table('stations')->select('Latitude','Longitude','Location')->where('stationCategory','=','aws')->orderBy('station_id', '>=','48')->get();
   //print_r($f);
   return view('auth/welcome',compact('data'));
     }

}

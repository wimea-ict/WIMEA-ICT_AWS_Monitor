<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
 
use DB;

class MakerereController extends Controller
{
    public function index()
    {
    

  $f= DB::table('TwoMeterNode')->select('V_IN','V_MCU','RTC_T','RH_SHT2X','T')->orderBy('id', 'desc')->where('NAME','fos-2m')->LIMIT(100)->get();
    $p= DB::table('TenMeterNode')->select('V_IN','V_MCU','RTC_T','V_A1','V_A2')->orderBy('id','desc')->where('NAME','fos-10m')->LIMIT(100)->get();
   $y= DB::table('GroundNode')->select('V_IN','V_MCU','RTC_T','P0_LST60','V_A1')->orderBy('id','desc')->where('NAME','fos-gnd')->LIMIT(100)->get();
   $z= DB::table('SinkNode')->select('V_IN','V_MCU','RTC_T','P_MS5611')->orderBy('id','desc')->where('NAME','makg3-sink')->LIMIT(100)->get();
  
   $m= DB::table('GeneralTable')->select('SOC','V_BAT','RTC_T')->orderBy('id','desc')->where('stationname','makg3')->LIMIT(1000)->get();

//print_r($m);
    return view('reports/makererestation',compact('f','p','y','z','m'));
    

     }

}

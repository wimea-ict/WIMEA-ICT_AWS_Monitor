<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BenchmarkingController extends Controller
{
    //
   public function index()
  {

  }

  public function entebbe_adcon_aws()
  {
    $heading="For Entebbe ";

    //$t2  = DB::select( DB::raw("SELECT DATE_FORMAT(TwoMeterNode.RTC_T, '%Y-%m-%d %H:%i:00') AS datetime, TwoMeterNode.T_SHT2X, uploads.temperature FROM TwoMeterNode INNER JOIN uploads ON TwoMeterNode.b2m_id = uploads.b2m_id WHERE TwoMeterNode.NAME = 'ebb-2m' ORDER BY datetime DESC LIMIT 20") );
    $e_rh = DB::table('uploads')->select('datetime','rh_wimea','rh_unma')->orderBy('id', 'desc')->where('station','Entebbe')->LIMIT(1000)->get();
    $e_t  = DB::table('uploads')->select('datetime','temp_unma','temp_wimea')->orderBy('id', 'desc')->where('station','Entebbe')->LIMIT(1000)->get();
    $e_p  = DB::table('uploads')->select('datetime','press_wimea','press_unma')->orderBy('id', 'desc')->where('station','Entebbe')->LIMIT(1000)->get();
    
    $ec_t  = DB::table('temperaturecalibration_wimea_unma')->orderBy('index','desc')->where('station','Entebbe')->LIMIT(1000)->get();
    $ec_rh = DB::table('humiditycalibration_wimea_unma')->orderBy('index','desc')->where('station','Entebbe')->LIMIT(1000)->get();
    $conf  = DB::table('calibration_values')->select('confidence_level')->orderBy('id','desc')->where('station_parameter','Entebbe_temperature')->LIMIT(1)->get();
    $conf1 = DB::table('calibration_values')->select('confidence_level')->orderBy('id','desc')->where('station_parameter','Entebbe_humidity')->LIMIT(1)->get();


    return view("reports.entebbebenchmarking",compact('heading','conf','conf1','e_t','ec_t','e_rh','ec_rh','e_p'));
  }

  public function kamuli_adcon_aws()
  {
    $heading="For Kamuli ";

    //$t2  = DB::select( DB::raw("SELECT DATE_FORMAT(TwoMeterNode.RTC_T, '%Y-%m-%d %H:%i:00') AS datetime, TwoMeterNode.T_SHT2X, uploads.temperature FROM TwoMeterNode INNER JOIN uploads ON TwoMeterNode.b2m_id = uploads.b2m_id WHERE TwoMeterNode.NAME = 'ebb-2m' ORDER BY datetime DESC LIMIT 20") );
    $k_rh = DB::table('uploads')->select('datetime','rh_wimea','rh_unma')->orderBy('id', 'asc')->where('station','Kamuli')->LIMIT(1000)->get();
    $k_t  = DB::table('uploads')->select('datetime','temp_unma','temp_wimea')->orderBy('datetime', 'asc')->where('station','Kamuli')->LIMIT(1000)->get();
    $k_p  = DB::table('uploads')->select('datetime','press_wimea','press_unma')->orderBy('datetime', 'asc')->where('station','Kamuli')->LIMIT(1000)->get();

    $kc_t  = DB::table('temperaturecalibration_wimea_unma')->orderBy('datetime','desc')->where('station','Kamuli')->LIMIT(1000)->get();
    $kc_p  = DB::table('pressurecalibration_wimea_unma')->orderBy('datetime','desc')->where('station','Kamuli')->LIMIT(1000)->get();
    $conf  = DB::table('calibration_values')->select('confidence_level')->orderBy('id','desc')->where('station_parameter','Kamuli_temperature')->LIMIT(1)->get();
    $conf1 = DB::table('calibration_values')->select('confidence_level')->orderBy('id','desc')->where('station_parameter','Kamuli_pressure')->LIMIT(1)->get();

    


    return view("reports.kamulibenchmarking",compact('heading','kc_p','kc_t','kc_rh','conf','conf1','k_t','k_rh','k_p'));
  }

  public function jinja_adcon_aws()
  {
    $heading="For Jinja";

    //$t2  = DB::select( DB::raw("SELECT DATE_FORMAT(TwoMeterNode.RTC_T, '%Y-%m-%d %H:%i:00') AS datetime, TwoMeterNode.T_SHT2X, uploads.temperature FROM TwoMeterNode INNER JOIN uploads ON TwoMeterNode.b2m_id = uploads.b2m_id WHERE TwoMeterNode.NAME = 'ebb-2m' ORDER BY datetime DESC LIMIT 20") );
    $j_rh = DB::table('uploads')->select('datetime','rh_wimea','rh_unma')->orderBy('id', 'desc')->where('station','Jinja')->LIMIT(1000)->get();
    $j_t  = DB::table('uploads')->select('datetime','temp_unma','temp_wimea')->orderBy('id', 'desc')->where('station','Jinja')->LIMIT(1000)->get();
    $j_p  = DB::table('uploads')->select('datetime','press_wimea','press_unma')->orderBy('id', 'desc')->where('station','Jinja')->LIMIT(1000)->get();
    


    return view("reports.jinjabenchmarking",compact('heading','j_t','j_rh','j_p'));
  }
}

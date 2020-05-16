<?php

namespace station\Http\Controllers;

//namespace station\Http\Controllers;

use App\layouts;
use station\Station;
use station\TwoMeterNode;
use station\TenMeterNode;
use station\SinkNode;
use station\GroundNode;
use station\Sensor;
use station\ReportIntervalClusters;
use station\ChangeTracker;
use station\Problems;
use station\PotentialProblem;
use station\DetectedAnalyzerProblems;
use Carbon\Carbon;
//use Illuminate\Http\Request;


use Illuminate\Http\Request;
//use station\Station;

class AnalyticController extends Controller
{
    //
   public function index()
  {

   // $data["headinga"]="Entebbe Station Reports";
	$stations = Station::all()->where("stationCategory","aws");

    return view("reports.analytic",compact('stations'));

  }
   public function show($id)
    {  
       

        $stationTaken = Station::where('station_id', $id)->first()->toArray();
        

    $data["headinga"]="Entebbe Station Reports";

		//$stations = Station::all()->where("stationCategory","aws");
		$axis = DetectedAnalyzerProblems::select('when_reported','Problem')->where('stationID', $id)->get()->toArray();
		$Reporting_intervals =ReportIntervalClusters::select('Node','cluster')->orderBy('id','DESC')->groupBy('Node' )->where('stationID', $id)->get();
//echo time() - (24*60*60);
    $packets_recieved_GND = GroundNode::whereDate('RTC_T', Carbon::today())->where('stationID', $id)->count();
    $packets_recieved_TMN = TenMeterNode::whereDate('RTC_T', Carbon::today())->where('stationID', $id)->count();
    $packets_recieved_TWN = TwoMeterNode::whereDate('RTC_T', Carbon::today())->where('stationID', $id)->count();
    $packets_recieved_SNK = SinkNode::whereDate('RTC_T', Carbon::today())->where('stationID', $id)->count();


		//'DATE', '>', Carbon::now()->subDays(1))->where('stationID',$id)
	$ids=TenMeterNode::where('stationID', $id)->limit(1)->get();
		
	
	//GroundNode;
    //return view("reports.analytic",$data,compact('stations'));


        return view('reports.selected_aws',$data,compact('stationTaken','axis','Reporting_intervals','tenMs','ids','Snks','Gnds','packets_recieved_GND','packets_recieved_TMN','packets_recieved_TWN','packets_recieved_SNK'));
    }

}

<?php

namespace station\Http\Controllers;

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
use Illuminate\Http\Request;

class StationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $stations_with_problems = array();
        $problems_identified = array();
        $TwoM= array();
        $TenM =array();
        $SinkN =array();
        $GroundN =array();
        $stations_off=array();

        $problems_identified = DetectedAnalyzerProblems::where('status', '<>','fixed')->where('Problem','<>','Packet dropping')->get()->toArray();
        $stations_off = DetectedAnalyzerProblems::where('Problem', '=', 'Station_off')->where('status', '<>','fixed')->get()->toArray(); 
        //$clusters = ReportIntervalClusters::take(500)->get()->toArray(); //DB::table('ReportIntervalClusters')->get()->toArray();       
       // $changetracker = ChangeTracker::get()->toArray();
        $stations = Station::all()->where("stationCategory","aws");
        foreach ($stations as $station) {
        $TwoM_lastcom = TwoMeterNode::orderBy('id','DESC')->where('stationID',$station['station_id'])->take(1)->get();
        $TwoM[$station['station_id']] = $TwoM_lastcom;

        //array_push($TwoM, $TwoM_lastcom);
        $TenM_lastcom =TenMeterNode::orderBy('id','DESC')->where('stationID',$station['station_id'])->take(1)->get();
        $TenM[$station['station_id']] = $TenM_lastcom;
        //array_push($TenM, $TenM_lastcom);
        $SinkN_lastcom =SinkNode::orderBy('id','DESC')->where('stationID',$station['station_id'])->take(1)->get();
        $SinkN[$station['station_id']] = $SinkN_lastcom;
              //  array_push($SinkN, $SinkN_lastcom);
        $GroundN_lastcom =GroundNode::orderBy('id','DESC')->where('stationID',$station['station_id'])->take(1)->get();	
        $GroundN[$station['station_id']] = $GroundN_lastcom;
               // array_push($GroundN, $GroundN_lastcom);


        	# code...
        }
	
        
       

    return view('layouts.viewStationStatus', compact('problems_identified','clusters','changetracker','stations','TwoM','TenM','SinkN','GroundN','stations_off'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
       

        $ids = array();
        $TwomNode = TwoMeterNode::where('stationID', $id)->take(1000)->get()->toArray();
        $TenmNode =TenMeterNode::where('stationID', $id)->take(1000)->get()->toArray();
        $sinknode =SinkNode::where('stationID', $id)->take(1000)->get()->toArray();
        $groundNode =GroundNode::where('stationID', $id)->take(1000)->get()->toArray();
        $problems_detail = DetectedAnalyzerProblems::where('stationID',$id)->where('status','<>','fixed')->get()->toArray(); 



        $twoMFlag = 0;
        $tenMFlag = 0;
        $gndFlag = 0;
        $sinkFlag = 0;
        $TempSensorFlag = 0;
        $SoilMoistureFlag = 0;
        $SoilTempFlag = 0;
        $PreciptationFlag = 0;
        $PressureFlag = 0;
        $RainfallFlag = 0;
        $WindSpeedFlag = 0;
        $WindDirectionFlag = 0;
        $insolationFlag = 0;
        $relativeHumidity = 0;



        $stationTaken = Station::where('station_id', $id)->first()->toArray();

        $classification = DetectedAnalyzerProblems::where('Problem', 'not like', "%off")->where('stationID',$id)->where('status','<>','fixed')->groupBy('NodeType','Problem')->get()->toArray();



        if(!empty($problems_detail)){
        foreach($problems_detail as $problem){
          //  echo $problem['when_reported'];


            //++++++++++++++++++++++++++++showing red++++++when a node is off
if(strcmp($problem['status'],"fixed")){
            if($problem['Problem']=="Station_off"){
                if($problem['stationID']== $id){
                    array_push($ids,array("id"=>$id, "source"=>$problem['NodeType']));
                  
                   $twoMFlag = 1;
                    $tenMFlag = 1;
                    $gndFlag = 1;
                    $sinkFlag = 1;
                    $TempSensorFlag = 1;
                    $SoilMoistureFlag = 1;
                    $SoilTempFlag = 1;
                    $PreciptationFlag = 1;
                    $PressureFlag = 1;
                    $RainfallFlag = 1;
                    $WindSpeedFlag = 1;
                    $WindDirectionFlag = 1;
                    $insolationFlag = 1;
                    $relativeHumidity = 1;
          
                }
            }
            elseif($problem['Problem']=="TwoMeterNode_off"){

            //echo($prob);
              
                if(!empty($TwomNode)){
                
                   if($problem['stationID']==$id){
                      //  array_push($ids,array("id"=>$TwomNode['stationID'], "source"=>$problem['NodeType']));
                        $twoMFlag = 1;
                        $TempSensorFlag = 1;
                        $relativeHumidity = 1;
                    }
                
              }
            }
          
            elseif($problem['Problem']=="TenMeterNode_off"){
                if(!empty($TenmNode)){
         
                    if($problem['stationID']==$id){
                        //array_push($ids,array("id"=>$TenmNode['stationID'], "source"=>$problem['NodeType']));
                        $tenMFlag = 1;
                        $WindSpeedFlag = 1;
                        $WindDirectionFlag = 1;
                        $insolationFlag = 1;
                    }
                }
         
            }
            elseif($problem['Problem']=="GroundNode_off"){
               // if(!empty($groundNode)){
                    if($problem['stationID']==$id){
                        //array_push($ids,array("id"=>$groundNode['stationID'], "source"=>$problem['NodeType']));
                        $gndFlag = 1;
                        $SoilMoistureFlag = 1;
                        $SoilTempFlag = 1;
                        $PreciptationFlag = 1;
                    }
               
           // }
        }
            elseif($problem['Problem']=="SinkNode_off"){
               // if(!empty($sinknode)){
                    if($problem['stationID']==$id){
                        //array_push($ids,array("id"=>$sinknode['stationID'], "source"=>$problem['NodeType']));
                        $sinkFlag = 1;
                        $PressureFlag = 1;
                    }
              //  }
            }
        
        //when node is on ======================================

            foreach ($classification as $classifiedPrb) {
            	# code...

            	if ($problem['stationID']==$classifiedPrb['stationID']) {
            		# code...
            	
            

if (($problem['Problem']==$classifiedPrb['Problem'])&& ($problem['NodeType']=="TenMeterNode")&&($tenMFlag!=1)){

	$tenMFlag=2;


}


if (($problem['Problem']==$classifiedPrb['Problem'])&& ($problem['NodeType']=="TwoMeterNode")&&($twoMFlag!=1)){

	$twoMFlag =2;


}


if (($problem['Problem']==$classifiedPrb['Problem'])&& ($problem['NodeType']=="GroundNode")&&($gndFlag !=1)){

	$gndFlag =2;


}


if (($problem['Problem']==$classifiedPrb['Problem'])&& ($problem['NodeType']=="SinkNode")&&($sinkFlag !=1)){

	$sinkFlag =2;


}

}
}

    }//when problem is not fixed
}//end of forloop





}


//=================================================================================================================================

//$changetrack=ChangeTracker::where('stationID',$id)->orderBy('id','DESC')->groupBy('stationID')->pluck('stationID')->toArray();

       // $sensorproblems=Problems::where('status', 'reported')->where('classification_id', '3')->pluck('source_id')->all();

        //$sensors = Sensor::whereIn('id', $sensorproblems)->get();
		
	$TwoM_sensors = TwoMeterNode::where('stationID',$id)->orderBy('id','DESC')->take(1)->get()->toArray();
    $TenM_sensors =TenMeterNode::where('stationID',$id)->orderBy('id','DESC')->take(1)->get()->toArray();
    $SinkN_sensors =SinkNode::where('stationID',$id)->orderBy('id','DESC')->take(1)->get()->toArray();
    $GroundN_sensors =GroundNode::where('stationID',$id)->orderBy('id','DESC')->take(1)->get()->toArray();

        if(!empty($TwoM_sensors)&& ($twoMFlag == 0)){

            foreach($TwoM_sensors as $Twomnodesensor){
                if(empty($Twomnodesensor['T_SHT2X'])){
                   // array_push($ids,array("id"=>$Twomnodesensor['id'], "source"=>"sensor"));
                    $TempSensorFlag = 1;
                }
                if(empty($Twomnodesensor['RH_SHT2X'])){
                    //array_push($ids,array("id"=>$Twomnodesensor['id'], "source"=>"sensor"));
                    $relativeHumidity = 1;
                }
            }
        }
        if(!empty($TenM_sensors)&&( $tenMFlag == 0)){
            foreach($TenM_sensors as $Tenmnodesensor){
                if(empty($Tenmnodesensor['PO_LST60'])){//PO_T instead ofPO_LST60
                   // array_push($ids,array("id"=>$Tenmnodesensor['id'], "source"=>"sensor"));
                    $WindSpeedFlag = 1;
                }
                if(empty($Tenmnodesensor['V_A1']) && empty($Tenmnodesensor['V_A2'])){
                    //array_push($ids,array("id"=>$Tenmnodesensor['id'], "source"=>"sensor"));
                    $WindDirectionFlag = 1;
                }
                if(empty($Tenmnodesensor['V_AD1']) && empty($Tenmnodesensor['V_AD2'])){
                   // array_push($ids,array("id"=>$Tenmnodesensor['id'], "source"=>"sensor"));
                    $insolationFlag = 1;
                }
            }
        }

        if(!empty($GroundN_sensors)&&($gndFlag == 0)){

            foreach($GroundN_sensors as $Groundnodesensor){
                if(empty($Groundnodesensor['T1'])){
                   // array_push($ids,array("id"=>$Groundnodesensor['id'], "source"=>"sensor"));
                    $SoilTempFlag = 1;
                }
                if(empty($Groundnodesensor['V_A1'])){
                   // array_push($ids,array("id"=>$Groundnodesensor['id'], "source"=>"sensor"));
                    $SoilMoistureFlag = 1;
                }
                if(empty($Tenmnodesensor['V_A1']) && empty($Tenmnodesensor['V_A2'])){
                    //array_push($ids,array("id"=>$Groundnodesensor['id'], "source"=>"sensor"));
                    $PreciptationFlag = 1;
                }
            }
        }

       // }
        if(!empty($SinkN_sensors)&&($sinkFlag == 0)){
            foreach($SinkN_sensors as $sinkNodesensor){
                if(empty($sinkNodesensor['P_MS5611'])){
                    //array_push($ids,array("id"=>$sinkNodesensors['id'], "source"=>"sensor"));
                    $PressureFlag = 1;
                }

            }
        }


        $problemsForStation = array();
        //print_r($ids); exit;
        $problemsForStation = DetectedAnalyzerProblems::groupBy('NodeType','Problem')->where('status','<>','fixed')->where('stationID',$id)->get();


        return view('layouts.selectedStationStatus',compact('twoMFlag','changetrack','tenMFlag','gndFlag','sinkFlag','TempSensorFlag','problems_detail','SoilMoistureFlag','SoilTempFlag','PreciptationFlag','PressureFlag','RainfallFlag','WindSpeedFlag','WindDirectionFlag','insolationFlag','relativeHumidity','stationTaken','problemsForStation','problemFrequencies','classification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    
    }

    public function archivedProblems($id){
                
        $problems = array();
        
        //find how to do joins in laravel 
        //find how to write to text files in laravel

        $problems = DetectedAnalyzerProblems::where('stationID', $id)->take(1000)->get()->toArray();
        $stationTaken = Station::where('station_id', $id)->first()->toArray();

        return view('layouts.archivedProblems', compact('problems','stationTaken'));
    }

}

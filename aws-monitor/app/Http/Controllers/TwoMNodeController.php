<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use station\Station;
use station\Sensor;
use station\TwoMeterNode;
use station\NodeStatus;
use station\ObservationSlip;
use station\Problems;
use DB;
use URL;
class TwoMNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::where('StationCategory', 'aws')->get();
        $twoMeterNodes = TwoMeterNode::all()->toArray();
        $relativeHumiditysensors = Sensor::where('node_type','twoMeterNode')
                                    ->where('parameter_read', 'relative humidity')
                                    ->get();
        $Temperaturesensors = Sensor::where('node_type','twoMeterNode')
                                    ->where('parameter_read', 'Temperature')
                                    ->get();

        return view('layouts.configureTwomNode', compact('twoMeterNodes','stations','relativeHumiditysensors','Temperaturesensors'));
    }

    public function report1(){
        $data["action"]=URL::to('reports2m');
        $data["stations"]=Station::all()->where("stationCategory","aws");
        $data["heading"]="2m Node Reports";

        $data["vin_vmcu_2m"]="";
        $data["humidity"]="";
        $data["templature"]="";
        return view("reports.node2m",$data);
    }


    public function get2mStationReports($id){
        $station_id=$id;
        $data=array();

       //get the txt value used for the particular station 2m node

       $station2mNodeCofigs = TwoMeterNode::where('station_id', '=', $station_id)
            ->select('txt_2m_value')
            ->first();

        if ($station2mNodeCofigs) {
        //get node status where the configulations are the ones specifie above
        $nodeStatus=NodeStatus::where('TXT','=',$station2mNodeCofigs->txt_2m_value)

                // DB::raw("CONCAT(date,' ',time)  AS y")
                        ->select("date_time_recorded AS y",'V_MCU','V_IN')
                        ->latest('date_time_recorded')
                        ->where('V_MCU','<>','')     //skip the empty fields
                        ->where('V_IN','<>','')
                        ->take(500)
                        ->get();

        }else{
            $nodeStatus=array();//set to empty array if no configulations were returned
        }
        
        $dyGraph_data="";
        //need to change instead of i pass the value of y but need to pass it as a string
        foreach($nodeStatus as $status){
          if($status->V_MCU=="" || $status->V_MCU==null){
           // $status->V_MCU=0;
          }

          if($status->V_IN=="" || $status->V_IN==null){
           // $status->V_IN=0;
          }

          if(!empty($status->V_MCU) && !empty($status->V_IN)){
            $temp_array=$status->y.",".(float)$status->V_MCU.",".(float)$status->V_IN."\\n";
            $dyGraph_data.=$temp_array;
          }

        }
        $data["vin_vmcu_2m"]=$dyGraph_data;

        //get values for other graphs as well


        //nop
        // DB::raw("CONCAT(date,' ',time)  AS y"),

         $humidity=ObservationSlip::where('Station','=',$station_id)
                        ->select("CreationDate AS y",'Wet_Bulb','Dry_Bulb')
                        ->latest('CreationDate')
                        ->where('Dry_Bulb','<>','')  //skip the empty fields
                        ->where('Wet_Bulb','<>','')
                        ->take(500)
                        ->get();
       
        $humidity_graph_data="";
        //wanted to fill zeros for the missing values if they are part of the selection-----------
        $arrival_rate = 60;
        $problems = Problems::where('source', '=', 'twoMeterNode')
                        ->where('classification_id', '=', 2)
                        ->where('status', '=', 'reported')
                        ->get();
                        
        foreach($problems as $problem){
            //find the last value recieved before the node went off
            $last_received = null;
            for($i = 0; $i < $humidity->count(); ++$i){
                if((new \DateTime($humidity[$i]->y)) <= (new \DateTime($problem->created_at))){
                    $last_received = $humidity[$i]->y;
                }
                else {
                    break;
                }
                
            }
            //find the first value received after the node was fixed.
            if(($last_received != null) && ($i+1 != count($humidity))){
                $later_received = $humidity[$i]->y;
                dd($last_received, $later_received);
            }
        }
        //-----------------------------------------------------------------------------------------
        //need to change instead of i pass the value of y but need to pass it as a string
        foreach($humidity as $humid){

            if(empty($humid->Dry_Bulb))
            {
               //$humid->Dry_Bulb=0;
            }

            if($humid->Dry_Bulb!=0){
                $hum_val=((150*$humid->Wet_Bulb)/$humid->Dry_Bulb)-50;
                $temp_array=$humid->y.",".(float)$hum_val."\\n";
                $humidity_graph_data.=$temp_array;
            }else if($humid->Dry_Bulb==0){
                  $hum_val=0;
                  $temp_array=$humid->y.",".(float)$hum_val."\\n";
                  $humidity_graph_data.=$temp_array;
            }



        }



        $data["humidity"]=$humidity_graph_data;
        //get the temperature
        $templature=ObservationSlip::where('station','=',$station_id)

                        ->select("CreationDate as y",'Dry_Bulb')
                        ->where('Dry_Bulb','<>','') //skip the empty values
                        ->latest('CreationDate')
                        ->take(500)
                        ->get();


        $temp_graph_data="";

        //need to change instead of i pass the value of y but need to pass it as a string
        foreach($templature as $temp){
            if(empty($temp->Dry_Bulb))
            {
                $temp->Dry_Bulb= 0;
            }
            else{
                $temp_array=$temp->y.",".(float)$temp->Dry_Bulb."\\n";
                $temp_graph_data.=$temp_array;
            }


        }

        $data["templature"]=$temp_graph_data;

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        //
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
    public function update(Request $request)
    {
        if($request->get('2mnode_id')!= null){
            $id=$request->get('2mnode_id');
            $TwomNode = TwoMeterNode::where('node_id',$id)->first();
            $TwomNode->txt_2m = $request->get('2txt_key');
            $TwomNode->e64_2m = $request->get('2mac_add');
            $TwomNode->v_in_2m = $request->get('2mvin_label');
            $TwomNode->time_2m = $request->get('2time');
            $TwomNode->ut_2m = $request->get('2ut');
            $TwomNode->date_2m = $request->get('2date');
            $TwomNode->gw_lat_2m = $request->get('2gwlat');
            $TwomNode->gw_long_2m = $request->get('2gwlong');
            $TwomNode->v_in_min_value = $request->get('2mv_in_max_value');
            $TwomNode->v_in_max_value = $request->get('2mv_in_min_value');
            $TwomNode->ttl_2m = $request->get('2ttl');
            $TwomNode->rssi_2m = $request->get('2rssi');
            $TwomNode->drp_2m = $request->get('2drp');
            $TwomNode->lqi_2m = $request->get('2lqi');
            $TwomNode->v_mcu_max_value = $request->get('2mv_mcu_max_value');
            $TwomNode->v_mcu_min_value = $request->get('2mv_mcu_min_value');
            $TwomNode->v_mcu_2m = $request->get('2mv_mcu_label');
            $TwomNode->t_sht2x_2m = $request->get('tsidentifier_used');
            $TwomNode->rh_sh2x_2m = $request->get('rhidentifier_used');
            $TwomNode->node_status= $this->getStatus($request,'2mnode_status');
            $TwomNode->txt_2m_value= $request->get('2txt_value');

            $TwomNode->save();
        $relativeHumidity = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'relative humidity')
                                    ->first();

            $relativeHumidity->parameter_read = $request->get('rhparameter_read');
            $relativeHumidity->identifier_used= $request->get('rhidentifier_used');
            $relativeHumidity->min_value = $request->get('rhmin_value');
            $relativeHumidity->max_value= $request->get('rhmax_value');
            $relativeHumidity->sensor_status= $this->getStatus($request,'rhsensor_status');
            $relativeHumidity->report_time_interval=$request->get('rhrptTime');
            $relativeHumidity->save();

        $temperature = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'Temperature')
                                    ->first();

            $temperature->parameter_read = $request->get('tsparameter_read');
            $temperature->identifier_used= $request->get('tsidentifier_used');
            $temperature->min_value = $request->get('tsmin_value');
            $temperature->max_value= $request->get('tsmax_value');
            $temperature->sensor_status= $this->getStatus($request,'tssensor_status');
            $temperature->report_time_interval=$request->get('tsrptTime');
            $temperature->save();



        }
        return redirect('/configure2mnode');

    }
    public function getStatus(Request $request, $status){
        $value = 'on';
          if($request->has($status)) {
            $value = 'on';
            }
            else{
                $value = 'off';
            }
        return $value;
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
}

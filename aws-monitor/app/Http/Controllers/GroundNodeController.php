<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use station\Station;
use station\Sensor;

use station\GroundNode;
use station\NodeStatus;
use station\ObservationSlip;
use DB;
use URL;
class GroundNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::where('StationCategory', 'aws')->get();
        $groundNodes = GroundNode::all()->toArray();


        $precipitationsensors = Sensor::where('node_type','groundNode')
                                    ->where('parameter_read', 'preciptation')
                                    ->get();

        $soilTempsensors = Sensor::where('node_type','groundNode')
                                    ->where('parameter_read', 'soil temperature')
                                    ->get();

        $soilMoisturesensors = Sensor::where('node_type','groundNode')
                                    ->where('parameter_read', 'soil moisture')
                                    ->get();

        return view('layouts.configureGroundNode',compact('groundNodes','stations','precipitationsensors','soilTempsensors','soilMoisturesensors'));

    }


    public function report1(){
        $data["action"]=URL::to('reportsGnd');
        $data["stations"]=Station::all()->where("stationCategory","aws");
        $data["heading"]="Ground Node Reports";

        $data["vin_vmcu"]="";
        $data["precipitation"]="";
        $data["soil_templature"]="";
        $data["soil_moisture"]="";
        return view("reports.nodegnd",$data);
    }


    public function getGndStationReports($id){
        $station_id=$id;
        $data=array();

       //get the txt value used for the particular station 10m node

       $stationgndNodeCofigs = GroundNode::where('station_id', '=', $station_id)
            ->select('txt_gnd_value')
            ->first();

        if($stationgndNodeCofigs){
             //get node status where the configulations are the ones specifie above
            $nodeStatus=NodeStatus::where('TXT','=',$stationgndNodeCofigs->txt_gnd_value)

                        ->select("date_time_recorded as y",'V_MCU','V_IN')
                        ->latest('date_time_recorded')
                        ->where('V_MCU','<>','')
                        ->where('V_IN','<>','')
                        ->take(500)
                        ->get();
        }else{
            $nodeStatus=array();//set it to an empty array
        }

        $dyGraph_data="";
        //need to change instead of i pass the value of y but need to pass it as a string
        foreach($nodeStatus as $status){
            if($status->V_MCU=="" || $status->V_MCU==null){
            //   $status->V_MCU=-1;
            }else if($status->V_IN=="" || $status->V_IN==null || $status->V_IN==0){
            //   $status->V_IN=-1;
            }

            $temp_array=$status->y.",".(float)$status->V_MCU.",".(float)$status->V_IN."\\n";
            $dyGraph_data.=$temp_array;

        }

        $data["vin_vmcu"]=$dyGraph_data;
        //get values for other graphs as well

        //get precipitation for ground node

         $precipitations=ObservationSlip::where('station','=',$station_id)

                        ->select("CreationDate as y",
                                    'DurationOfPeriodOfPrecipitation')
                        ->latest('CreationDate')
                        ->where('DurationOfPeriodOfPrecipitation','<>','')
                        ->take(500)
                        ->get();

        $precipitation_graph_data="";

        //need to change instead of i pass the value of y but need to pass it as a string
        foreach($precipitations as $precipitation){
          if(empty($precipitation->DurationOfPeriodOfPrecipitation)){
            // $precipitation->DurationOfPeriodOfPrecipitation=-1;
          }

            $temp_array=$precipitation->y.",".(float)$precipitation->DurationOfPeriodOfPrecipitation."\\n";
            $precipitation_graph_data.=$temp_array;



        }

        $data["precipitation"]=$precipitation_graph_data;


        //get soil teplature
        $soilTemplature=ObservationSlip::where('station','=',$station_id)

                        ->select("creationDate as y",'SoilTemperature')
                        ->latest('creationDate')
                        ->where('SoilTemperature','<>','')
                        ->take(500)
                        ->get();

        $soilTemplature_graph_data="";

        //need to change instead of i pass the value of y but need to pass it as a string
        foreach($soilTemplature as $soilTemp){
          if(empty($soilTemp->SoilTemperature)){
            // $soilTemp->SoilTemperature=-1;
          }

          $temp_array=$soilTemp->y.",".(float)$soilTemp->SoilTemperature."\\n";
          $soilTemplature_graph_data.=$temp_array;

        }

        $data["soil_templature"]=$soilTemplature_graph_data;
        //get soil moisture

        $SoilMoisture=ObservationSlip::where('station','=',$station_id)

                        ->select("CreationDate as y",'SoilMoisture')
                        ->latest('CreationDate')
                        ->where('SoilMoisture','<>','') //skip the empty values
                        ->take(500)
                        ->get();

        $SoilMoisture_graph_data="";

        //need to change instead of i pass the value of y but need to pass it as a string
        foreach($SoilMoisture as $SoilMois){
          if(empty($SoilMois->SoilMoisture)){
               //$SoilMois->SoilMoisture=-1;
          }
          
          $temp_array=$SoilMois->y.",".(float)$SoilMois->SoilMoisture."\\n";
          $SoilMoisture_graph_data.=$temp_array;

        }

        $data["soil_moisture"]=$SoilMoisture_graph_data;

        return $data;
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
    { $va1gnd = explode(',',$request->get('smidentifier_used'));
        if($request->get('gndnode_id')!= null){
            $id=$request->get('gndnode_id');
            $groundNode = GroundNode::where('node_id',$id)->first();
            $groundNode->txt_gnd = $request->get('gndtxt_key');
            $groundNode->e64_gnd = $request->get('gndmac_add');
            $groundNode->v_in_gnd = $request->get('gndvin_label');
            $groundNode->time_gnd = $request->get('grndtime');
            $groundNode->ut_gnd = $request->get('gndut');
            $groundNode->date_gnd = $request->get('gnddate');
            $groundNode->gw_lat_gnd = $request->get('gndgwlat');
            $groundNode->gw_long_gnd = $request->get('gndgwlong');
            $groundNode->v_in_min_value = $request->get('gndv_in_min_value');
            $groundNode->v_in_max_value = $request->get('gdv_in_max_value');
            $groundNode->ttl_gnd = $request->get('gndttl');
            $groundNode->rssi_gnd = $request->get('gndrssi');
            $groundNode->drp_gnd = $request->get('gnddrp');
            $groundNode->lqi_gnd = $request->get('gndlqi');
            $groundNode->v_mcu_max_value = $request->get('gdv_mcu_max_value');
            $groundNode->v_mcu_min_value = $request->get('gdv_mcu_min_value');
            $groundNode->v_mcu_gnd  = $request->get('gdv_mcu_label');
            $groundNode->v_a1_gnd= $va1gnd[0];
            $groundNode->v_a2_gnd =$request->get('v_a2');
            $groundNode->ps_gnd =$request->get('groundps');
            $groundNode->node_status= $this->getStatus($request,'gndnode_status');
            $groundNode->txt_gnd_value = $request->get('gndtxt_value');
            $groundNode->up_gnd = $request->get('gndup');
            $groundNode->p0_lst60_gnd = $request->get('groundpo');
            $groundNode->t1_gnd = $request->get('stidentifier_used');
            $groundNode->t_gnd = $request->get('gndt');

            $groundNode->save();
        $soilTemperature = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'soil temperature')
                                    ->first();

            $soilTemperature->parameter_read = $request->get('stparameter_read');
            $soilTemperature->identifier_used= $request->get('stidentifier_used');
            $soilTemperature->min_value = $request->get('stmin_value');
            $soilTemperature->max_value= $request->get('stmax_value');
            $soilTemperature->sensor_status= $this->getStatus($request,'stsensor_status');
            $soilTemperature->report_time_interval=$request->get('strptTime');
            $soilTemperature->save();

        $soilMoisture = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'soil moisture')
                                    ->first();

            $soilMoisture->parameter_read = $request->get('smparameter_read');
            $soilMoisture->identifier_used= $request->get('smidentifier_used');
            $soilMoisture->min_value = $request->get('smmin_value');
            $soilMoisture->max_value= $request->get('smmax_value');
            $soilMoisture->sensor_status= $this->getStatus($request,'smsensor_status');
            $soilMoisture->report_time_interval=$request->get('smrptTime');
            $soilMoisture->save();

        $preciptation = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'preciptation')
                                    ->first();

            $preciptation->parameter_read = $request->get('ppparameter_read');
            $preciptation->identifier_used= $request->get('ppidentifier_used');
            $preciptation->min_value = $request->get('ppmin_value');
            $preciptation->max_value= $request->get('ppmax_value');
            $preciptation->sensor_status= $this->getStatus($request,'ppsensor_status');
            $preciptation->report_time_interval=$request->get('pprptTime');
            $preciptation->save();



        }
        return redirect('/configuregroundnode');
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

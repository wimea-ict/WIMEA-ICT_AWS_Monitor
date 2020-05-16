<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use station\Station;
use station\Sensor;

use station\TenMeterNode;
use station\NodeStatus;
use DB;
use URL;
use station\ObservationSlip;
class TenMNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::where('StationCategory', 'aws')->get();
        $tenMeterNodes = TenMeterNode::all()->toArray();
        $insulationsensors = Sensor::where('node_type','tenMeterNode')
                                    ->where('parameter_read', 'insulation')
                                    ->get();
        $windspeedsensors = Sensor::where('node_type','tenMeterNode')
                                    ->where('parameter_read', 'wind speed')
                                    ->get();
        $winddirectionsensors = Sensor::where('node_type','tenMeterNode')
                                    ->where('parameter_read', 'wind direction')
                                    ->get();


        return view('layouts.configureTenmNode',compact('tenMeterNodes','stations','insulationsensors','windspeedsensors','winddirectionsensors'));
    }


    public function report1(){
        $data["action"]=URL::to('reports10m');
        $data["stations"]=Station::all()->where("stationCategory","aws");
        $data["heading"]="10m Node Reports";

        $data["vin_vmcu_10m"]="";
        $data["insulation_sensor"]="";
        $data["windspeed_sensor"]="";
        $data["wind_direction_sensor"]="";
        return view("reports.node10m",$data);
    }


    public function get10mStationReports($id){
        $station_id=$id;
        $data=array();

       //get the txt value used for the particular station 10m node

       $station10mNodeCofigs = TenMeterNode::where('station_id', '=', $station_id)
            ->select('txt_10m_value')
            ->first();

        if($station10mNodeCofigs){
             //get node status where the configulations are the ones specifie above
            $nodeStatus=NodeStatus::where('TXT','=',$station10mNodeCofigs->txt_10m_value)

                        ->select("date_time_recorded AS y",'V_MCU','V_IN')
                        ->latest('date_time_recorded')
                        ->where('V_MCU','<>','')
                        ->where('V_IN','<>','')
                        ->take(1000)
                        ->get();

        }else{
            $nodeStatus=array();// set to empty array if no configulations where returned
        }


        $dyGraph_data="";

        foreach($nodeStatus as $status){
            if($status->V_MCU=="" || $status->V_MCU==null ){
            //   $status->V_MCU=-1;
            }

            if($status->V_IN=="" || $status->V_IN==null ){
            //   $status->V_IN=-1;
            }

            $temp_array=$status->y.",".(float)$status->V_MCU.",".(float)$status->V_IN."\\n";
            $dyGraph_data.=$temp_array;

        }


        $data["vin_vmcu_10m"]=$dyGraph_data;
        //get values for other graphs as well
        //get precipitation for ground node

         $insulation=ObservationSlip::where('station','=',$station_id)

                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'DurationOfPeriodOfPrecipitation')
                        ->latest('creationDate')
                        ->where('DurationOfPeriodOfPrecipitation','<>','')
                        ->take(1000)
                        ->get();


        $insulation_data="";

        foreach($insulation as $insulation){
          if(empty($insulation->DurationOfPeriodOfPrecipitation)){
            // $insulation->DurationOfPeriodOfPrecipitation-1;
          }

            $temp_array=$insulation->y.",".(float)$insulation->DurationOfPeriodOfPrecipitation."\\n";
            $insulation_data.=$temp_array;

        }

        $data["insulation_sensor"]=$insulation_data;


        //get soil teplature
        $windspeed=ObservationSlip::where('station','=',$station_id)

                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'Wind_Speed')
                        ->latest('CreationDate')
                        ->where('Wind_Speed','<>','')
                        ->take(1000)
                        ->get();

        $windspeed_data="";

        foreach($windspeed as $windsp){
          if(empty($windsp->Wind_Speed)){
            // $windsp->Wind_Speed=-1;
          }

            $temp_array=$windsp->y.",".(float)$windsp->Wind_Speed."\\n";
            $windspeed_data.=$temp_array;

        }


        $data["windspeed_sensor"]=$windspeed_data;
        //get soil moisture

        $wind_direction=ObservationSlip::where('station','=',$station_id)

                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'Wind_Direction')
                        ->latest('CreationDate')
                        ->where('Wind_Direction','<>','')
                        ->take(1000)
                        ->get();

      $wind_direction_data="";

      foreach($wind_direction as $wind_d){
          if(empty($wind_d->Wind_Direction)){
            // $wind_d->Wind_Direction=-1;
          }

          $temp_array=$wind_d->y.",".(float)$wind_d->Wind_Direction;

          $wind_direction_data.=$temp_array;
          }


        $data["wind_direction_sensor"]=$wind_direction_data;

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
    {
        $vadArray = explode(',', $request->get('10identifier_used'));
        $va1Array = explode(',', $request->get('wdidentifier_used'));

        if($request->get('10node_id')!= null){
            $id=$request->get('10node_id');
            $TenmNode = TenMeterNode::where('node_id',$id)->first();
            $TenmNode->txt_10m = $request->get('10txt_key');
            $TenmNode->e64_10m = $request->get('10mac_add');
            $TenmNode->v_in_10m = $request->get('10vin_label');
            $TenmNode->time_10m = $request->get('10time');
            $TenmNode->ut_10m = $request->get('10ut');
            $TenmNode->date_10m = $request->get('10date');
            $TenmNode->gw_lat_10m = $request->get('10gwlat');
            $TenmNode->gw_long_10m = $request->get('10gwlong');
            $TenmNode->v_in_min_value = $request->get('10v_in_max_value');
            $TenmNode->v_in_max_value = $request->get('10v_in_min_value');
            $TenmNode->ttl_10m = $request->get('10ttl');
            $TenmNode->rssi_10m = $request->get('10rssi');
            $TenmNode->drp_10m = $request->get('10drp');
            $TenmNode->lqi_10m = $request->get('10lqi');
            $TenmNode->ps_10m = $request->get('10ps');
            $TenmNode->v_mcu_max_value =  $request->get('10v_mcu_max_value');
            $TenmNode->v_mcu_min_value =  $request->get('10v_mcu_min_value');
            $TenmNode->v_mcu_10m =  $request->get('10v_mcu_label');
            $TenmNode->v_a1_10m= $va1Array[0];
            $TenmNode->v_a2_10m= $va1Array[1];
            $TenmNode->v_a3_10m= 'V_A3';
            $TenmNode->v_ad1_10m= $vadArray[0];
            $TenmNode->v_ad2_10m= $vadArray[1];

            $TenmNode->node_status= $this->getStatus($request,'10mnode_status');
            $TenmNode->txt_10m_value= $request->get('10txt_value');

            $TenmNode->save();
        $insulation = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'insulation')
                                    ->first();

            $insulation->parameter_read = $request->get('10parameter_read');
            $insulation->identifier_used= $request->get('10identifier_used');
            $insulation->min_value = $request->get('10min_value');
            $insulation->max_value= $request->get('10max_value');
            $insulation->sensor_status= $this->getStatus($request,'10sensor_status');
            $insulation->report_time_interval=$request->get('10rptTime');
            $insulation->save();

        $windspeed = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'wind speed')
                                    ->first();

            $windspeed->parameter_read = $request->get('wsparameter_read');
            $windspeed->identifier_used= $request->get('wsidentifier_used');
            $windspeed->min_value = $request->get('wsmin_value');
            $windspeed->max_value= $request->get('wsmax_value');
            $windspeed->sensor_status= $this->getStatus($request,'wssensor_status');
            $windspeed->report_time_interval=$request->get('wsrptTime');
            $windspeed->save();

        $winddirection = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'wind direction')
                                    ->first();

            $winddirection->parameter_read = $request->get('wdparameter_read');
            $winddirection->identifier_used= $request->get('wdidentifier_used');
            $winddirection->min_value = $request->get('wdmin_value');
            $winddirection->max_value= $request->get('wdmax_value');
            $winddirection->sensor_status= $this->getStatus($request,'wdsensor_status');
            $winddirection->report_time_interval=$request->get('wdrptTime');
            $winddirection->save();

        }
        return redirect('/configure10mnode');
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

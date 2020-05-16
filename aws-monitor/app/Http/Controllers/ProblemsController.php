<?php

namespace station\Http\Controllers;

use App\layouts;
use station\Station;
use station\problemConfigurations;

use Illuminate\Http\Request;

class ProblemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stationIDs = problemConfigurations::pluck('station_id');
        //dd($stations);

        $stations = Station::where('StationCategory', 'aws')->whereIn('station_id',$stationIDs)->get()->toArray();
        $problemConfigurationvalues = problemConfigurations::all()->toArray();
        //$stations = Station::whereIn('station_id', $problemConfigurationvalues)->get();
        return view('layouts.editProblemConfigurations', compact('stations','problemConfigurationvalues'));
    
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
        if($request->get('station_id')!= null){
            $id=$request->get('station_id');
        //$problems = problemConfigurations::where('id', $id)->first();

        //updating station off problems configurations
        $station_off = problemConfigurations::where('station_id',$id)
                                    ->where('problem_id', 1)
                                    ->first();
            $station_off->report_method =$request->get('sorptmethod');
            $station_off->reporting_time_interval= $request->get('soprobRptTime');
            $station_off->save();
            //updating node off problems configurations
        $node_off = problemConfigurations::where('station_id',$id)
                                    ->where('problem_id', 2)
                                    ->first();
            $node_off->max_track_counter = $request->get('nooccurencesConsider');
            $node_off->report_method =$request->get('norptmethod');
            $node_off->criticality= $request->get('nocriticallity');
            $node_off->reporting_time_interval= $request->get('noprobRptTime');
            $node_off->save();
        //updatind sensor off problem configurations
        $sensor_off = problemConfigurations::where('station_id',$id)
                                    ->where('problem_id', 3)
                                    ->first();
            $sensor_off->max_track_counter = $request->get('ssoccurencesConsider');
            $sensor_off->report_method =$request->get('ssorptmethod');
            $sensor_off->criticality= $request->get('ssocriticallity');
            $sensor_off->reporting_time_interval= $request->get('ssoprobRptTime');
            $sensor_off->save();
        //updating lower node values                            
        $lownode_values = problemConfigurations::where('station_id',$id)
                                    ->where('problem_id', 4)
                                    ->first();  
            $lownode_values->max_track_counter = $request->get('lpoccurencesConsider');
            $lownode_values->report_method =$request->get('lprptmethod');
            $lownode_values->criticality= $request->get('lpcriticallity');
            $lownode_values->reporting_time_interval= $request->get('lpprobRptTime');
            $lownode_values->save();  
        $missing_sensor_values = problemConfigurations::where('station_id',$id)
                                    ->where('problem_id', 5)
                                    ->first();
            $missing_sensor_values->max_track_counter = $request->get('msoccurencesConsider');
            $missing_sensor_values->report_method =$request->get('msrptmethod');
            $missing_sensor_values->criticality= $request->get('mscriticallity');
            $missing_sensor_values->reporting_time_interval= $request->get('msprobRptTime');
            $missing_sensor_values->save(); 
        $missing_node_values = problemConfigurations::where('station_id',$id)
                                    ->where('problem_id', 6)
                                    ->first();
            $missing_node_values->max_track_counter = $request->get('nmoccurencesConsider');
            $missing_node_values->report_method =$request->get('nmrptmethod');
            $missing_node_values->criticality= $request->get('nmcriticallity');
            $missing_node_values->reporting_time_interval= $request->get('nmprobRptTime');
            $missing_node_values->save(); 
        $incorrect_dates = problemConfigurations::where('station_id',$id)
                                    ->where('problem_id', 7)
                                    ->first();
            $incorrect_dates->max_track_counter = $request->get('idoccurencesConsider');
            $incorrect_dates->report_method =$request->get('idrptmethod');
            $incorrect_dates->criticality= $request->get('idcriticallity');
            $incorrect_dates->reporting_time_interval= $request->get('idprobRptTime');
            $incorrect_dates->save();          
        $incorrect_sensor_values = problemConfigurations::where('station_id',$id)
                                    ->where('problem_id', 8)
                                    ->first();      
            $incorrect_sensor_values->max_track_counter = $request->get('isoccurencesConsider');
            $incorrect_sensor_values->report_method =$request->get('isrptmethod');
            $incorrect_sensor_values->criticality= $request->get('iscriticallity');
            $incorrect_sensor_values->reporting_time_interval= $request->get('isprobRptTime');
        
            $incorrect_sensor_values->save();
            
        $packet_drop_values = problemConfigurations::where('station_id',$id)
                                    ->where('problem_id', 9)
                                    ->first();      
            $packet_drop_values->max_track_counter = $request->get('pdoccurencesConsider');
            $packet_drop_values->report_method =$request->get('pdrptmethod');
            $packet_drop_values->criticality= $request->get('pdcriticallity');
            $packet_drop_values->reporting_time_interval= $request->get('pdprobRptTime');
        
            $packet_drop_values->save();
        
            return redirect('/editProblemConfigurations');
        }
        else{
        return redirect('/addstation');
        }
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

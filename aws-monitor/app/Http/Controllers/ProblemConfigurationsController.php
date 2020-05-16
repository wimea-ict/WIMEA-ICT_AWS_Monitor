<?php

namespace station\Http\Controllers;
use App\layouts;
use station\Station;
use station\problemConfigurations;
use Illuminate\Http\Request;

class ProblemConfigurationsController extends Controller
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

        $stations = Station::where('StationCategory', 'aws')->whereNotIn('station_id',$stationIDs)->get()->toArray();
        
        //dd($stations);
        return view('layouts.configureProblems', compact('stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editForm()
    {
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        
        $problem_defaults = array (
            "max_counter"=>"4",
            "report_method"=>"Both",
            "criticality"=>"Critical",
            "rpt_interval"=>"8",
        );
        
        //$station = Station::where('StationName', $request->get('station_selected'))->first();
        
        $stationOffconfiguration = new problemConfigurations([
            'station_id'=> $id,
            'max_track_counter'=>$problem_defaults["max_counter"],
            'problem_id'=>1,
            'report_method'=>$problem_defaults["report_method"],
            'criticality'=>$problem_defaults["criticality"],
            'reporting_time_interval'=>$problem_defaults["rpt_interval"],
        
        ]);
        $stationOffconfiguration->save();
        $NodeOffconfiguration = new problemConfigurations([
            'station_id'=> $id,
            'max_track_counter'=>$problem_defaults["max_counter"],
            'problem_id'=>2,
            'report_method'=>$problem_defaults["report_method"],
            'criticality'=>$problem_defaults["criticality"],
            'reporting_time_interval'=>$problem_defaults["rpt_interval"],
        
        ]);
        $NodeOffconfiguration->save();
        $sensorOffconfiguration = new problemConfigurations([
            'station_id'=> $id,
            'max_track_counter'=>$problem_defaults["max_counter"],
            'problem_id'=>3,
            'report_method'=>$problem_defaults["report_method"],
            'criticality'=>$problem_defaults["criticality"],
            'reporting_time_interval'=>$problem_defaults["rpt_interval"],
        
        ]);
        $sensorOffconfiguration->save();
        $lownodeValuesconfiguration = new problemConfigurations([
            'station_id'=> $id,
            'max_track_counter'=>$problem_defaults["max_counter"],
            'problem_id'=>4,
            'report_method'=>$problem_defaults["report_method"],
            'criticality'=>$problem_defaults["criticality"],
            'reporting_time_interval'=>$problem_defaults["rpt_interval"],
        
        ]);
        $lownodeValuesconfiguration->save();

        $missingSensorValuesconfiguration = new problemConfigurations([
            'station_id'=> $id,
            'max_track_counter'=>$problem_defaults["max_counter"],
            'problem_id'=>5,
            'report_method'=>$problem_defaults["report_method"],
            'criticality'=>$problem_defaults["criticality"],
            'reporting_time_interval'=>$problem_defaults["rpt_interval"],
        ]);
        $missingSensorValuesconfiguration->save();
        $missingnodeValuesconfiguration = new problemConfigurations([
            'station_id'=> $id,
            'max_track_counter'=>$problem_defaults["max_counter"],
            'problem_id'=>6,
            'report_method'=>$problem_defaults["report_method"],
            'criticality'=>$problem_defaults["criticality"],
            'reporting_time_interval'=>$problem_defaults["rpt_interval"],
        ]);
        $missingnodeValuesconfiguration->save();
        $incorrectDateValuesconfiguration = new problemConfigurations([
            'station_id'=> $id,
            'max_track_counter'=>$problem_defaults["max_counter"],
            'problem_id'=>7,
            'report_method'=>$problem_defaults["report_method"],
            'criticality'=>$problem_defaults["criticality"],
            'reporting_time_interval'=>$problem_defaults["rpt_interval"],
        
        ]);
        $incorrectDateValuesconfiguration->save();

        $incorrectSensorValuesconfiguration = new problemConfigurations([
            'station_id'=> $id,
            'max_track_counter'=>$problem_defaults["max_counter"],
            'problem_id'=>8,
            'report_method'=>$problem_defaults["report_method"],
            'criticality'=>$problem_defaults["criticality"],
            'reporting_time_interval'=>$problem_defaults["rpt_interval"],
        
        ]);
        $incorrectSensorValuesconfiguration->save();

        $packetDroppingProblems = new problemConfigurations([
            'station_id'=> $id,
            'max_track_counter'=>$problem_defaults["max_counter"],
            'problem_id'=>9,
            'report_method'=>$problem_defaults["report_method"],
            'criticality'=>$problem_defaults["criticality"],
            'reporting_time_interval'=>$problem_defaults["rpt_interval"],
        
        ]);
        $packetDroppingProblems->save();

        $SensorsAboveLevel = new problemConfigurations([
            'station_id'=> $id,
            'max_track_counter'=>$problem_defaults["max_counter"],
            'problem_id'=>10,
            'report_method'=>$problem_defaults["report_method"],
            'criticality'=>$problem_defaults["criticality"],
            'reporting_time_interval'=>$problem_defaults["rpt_interval"],
        
        ]);
        $SensorsAboveLevel->save();

        return;

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

}

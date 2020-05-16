<?php

namespace station\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use station\Http\Controllers\Controller;
use station\Http\Controllers\AnalyzerHandler;

class ViewAnalyzerData extends Controller
{
    private $Handler;
    public function __construct()
    {
        $this->Handler = new AnalyzerHandler();
    }
    public function showProbTable()
    {
        //get data in problems table   problems
        //source, source_id, criticality, classification_id, track_counter, status
        $data = DB::table('problems')->get();
        $problems = DB::table('problem_classification')->get();

        $data->transform(function($problem){
            $names =  $this->Handler->problemStationNames($problem->source, $problem->source_id);
            $problem->stn_name = $names['stn_name'];
            $problem->parameter_read = $names['parameter_read'];
            $problem->lasted_for = Carbon::parse($problem->created_at)->diffForHumans(null, true);
            return $problem;
        });

        return view('layouts.analyzer', compact('data','problems'));
    }

    public function viewProblemLogFile()
    {
        return response()->file('/var/www/html/awsmonitor/aws-monitor/storage/logs/problems.log');
    }

    public function downloadProblemLogFile()
    {
        return response()->download('/var/www/html/awsmonitor/aws-monitor/storage/logs/problems.log', "problems.logs");
    }

    public function viewUserLogFile()
    {
        return response()->file('/var/www/html/awsmonitor/aws-monitor/storage/logs/userActions.log');
    }

    public function downLoadUserLogFile()
    {
        return response()->download('/var/www/html/awsmonitor/aws-monitor/storage/logs/userActions.log', "userActions.logs");
    }
}

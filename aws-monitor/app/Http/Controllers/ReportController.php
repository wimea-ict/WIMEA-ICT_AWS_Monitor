<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use station\Http\Controllers\Controller;
use DB;
use station\Report;
use Carbon\Carbon;
use Twilio\Rest\Client;
use Log;

class ReportController extends Controller
{
    public function report(){
        //get all the problems with status reported

        $reported_problems = DB::table('problems')
                ->where('status','reported')->get();

        foreach($reported_problems as $problem){
            //check if the problem exists in the reports table

            //get the problems orign station to determine report method
            // return array($problem->source,$problem->source_id);
            $problem_station=$this->getStationId($problem->source,$problem->source_id);

            $mstation_id=$problem_station["station_id"];


            $m_node=$problem->source;



            //get reporting type
            $reporting_mthd_interval=DB::table("station_problem_settings")
                            ->select("report_method","reporting_time_interval")
                            ->where('problem_id',$problem->classification_id)
                            ->where('station_id',$problem_station["station_id"])->first();

            $problem_description=DB::table('problem_classification')
                ->select("problem_description")
                ->where('id',$problem->classification_id)->first();



            if(!empty($reporting_mthd_interval)){
                $reporting_type=$reporting_mthd_interval->report_method;
                $interval=$reporting_mthd_interval->reporting_time_interval;

            }else{
                //use default
                $reporting_type="email";

                $interval=10;
            }

            $problem_report=DB::table('reports')
                ->where('problem_id',$problem->id)->orderBy('report_id', 'desc')->first();


            if(empty($problem_report)){

                //insert the problem
                Report::create([
                    "problem_id"=>$problem->id,
                    "message"=>$problem_station["source"],
                    "report_counter"=>1,
                    "station_id"=>$mstation_id,
                    "node"=>(($m_node=="station")?"":$m_node)
                    ]);

                //report the problem
                $message=$problem_station["source"]." \n".$problem_description->problem_description;
                $this->sendReport($reporting_type,$problem_station["source"],$message);
            }else{

                $date=Carbon::parse($problem_report->datetime);


                $now = Carbon::now();
                $now=$now->addHours(3);//to change it to east african time

                $diff = $date->diffInHours($now);

                if($diff>=$interval){

                    Report::create([
                    "problem_id"=>$problem->id,
                    "message"=>$problem_station["source"],
                    "report_counter"=>(++$problem_report->report_counter),
                    "station_id"=>$mstation_id,
                    "node"=>(($m_node=="station")?"":$m_node)

                    ]);

                    $message=$problem_station["source"]." ".$problem_description->problem_description;
                    $this->sendReport($reporting_type,$problem_station["source"],$message);
                }else{
                    //do nothing
                }

                //check time difference btn now and last reporting time

                //get the problem description from problem configuration table
                //check reporting type and report the problem



            }
        }

        // return $reported_problems;

    }

    public function sendReport($type,$source,$message1){

      // Create an authenticated client for the Twilio API
      // $client = new Client(env('TWILIO_ACCOUNT_SID'), env('MTWILIO_AUTH_TOKEN'));

      $accountSid ='AC17a43cdfd181a7f3644ec5985c762ba8';//env('TWILIO_ACCOUNT_SID');
      $authToken = 'f02338157367fed0518f0d91a67da0c1';//env('TWILIO_AUTH_TOKEN');
      $twilioNumber ='+18055002908'; //env('TWILIO_NUMBER');
      $to='+256775388044';
      $client = new Client($accountSid, $authToken);

        if($type=="sms"){
            //send via sms

            // Get form inputs

        $message = $message1;

        try {
            $client->messages->create(
                $to,
                [
                    "body" => $message,
                    "from" => $twilioNumber
                    //   On US phone numbers, you could send an image as well!
                    //  'mediaUrl' => $imageUrl
                ]
            );
            Log::info('Message sent to ' . $twilioNumber);
        } catch (TwilioException $e) {
            Log::error(
                'Could not send SMS notification.' .
                ' Twilio replied with: ' . $e
            );
        }

        //end sms
        }else if($type=="email"){
            //send via email
            \Mail::raw($message1, function($message)
            {
                $message->subject('WIMEA ICT REPORT');
                $message->from('byarus90@gmail.com', 'WIMEA ICT');
                $message->to('graceolive8@gmail.com');
            });

        }else if($type=="Both" || $type=="both"){
            //use both email and sms

            //send via email
            \Mail::raw($message1, function($message)
            {
                $message->subject('WIMEA ICT REPORT');
                $message->from('byarus90@gmail.com', 'WIMEA ICT');
                  $message->to($email);

                $message->cc(['austinstanleybi@gmail.com','victoriasharon1@gmail.com']);
                $message->send(new document());

            });

            $message = $message1;

            try {
                $client->messages->create(
                    $to,
                    [
                        "body" => $message,
                        "from" => $twilioNumber
                        //   On US phone numbers, you could send an image as well!
                        //  'mediaUrl' => $imageUrl
                    ]
                );
                Log::info('Message sent to ' . $twilioNumber);
            } catch (TwilioException $e) {
                Log::error(
                    'Could not send SMS notification.' .
                    ' Twilio replied with: ' . $e
                );
            }

          }

    }

    //this method is used to get station id depending on problem source and source id
    public function getStationId($source,$source_id){
        $data=array();
        switch($source){
            case "twoMeterNode":
                //get station id and station name from 2m_node table
              $two_meter=DB::table('twoMeterNode')
                ->join('stations','stations.station_id','=','twoMeterNode.station_id')
                ->select('twoMeterNode.station_id as station_id','stations.StationName as StationName')
                ->where('twoMeterNode.node_id',$source_id)->get();

                $data["source"]=$two_meter[0]->StationName."'s "."2m Node";
                $data["station_id"]=$two_meter[0]->station_id;

            break;

            case "tenMeterNode":
                //get station id from 10m node table
                $ten_meter=DB::table('tenMeterNode')
                ->join('stations','stations.station_id','=','tenMeterNode.station_id')
                ->select('tenMeterNode.station_id as station_id','stations.StationName as StationName')
                ->where('tenMeterNode.node_id',$source_id)->get();

                $data["source"]=$ten_meter[0]->StationName."'s "."10m Node";
                $data["station_id"]=$ten_meter[0]->station_id;
            break;

            case "sinkNode":
                //get station_id from sink node table
                $sink_node=DB::table('sinkNode')
                ->join('stations','stations.station_id','=','sinkNode.station_id')
                ->select('sinkNode.station_id as station_id','stations.StationName as StationName')
                ->where('sinkNode.node_id',$source_id)->get();

                $data["source"]=$sink_node[0]->StationName."'s "."Sink Node";
                $data["station_id"]=$sink_node[0]->station_id;
            break;

            case "groundNode":
                //get station id from grnode table

                //
                $ground_node=DB::table('groundNode')
                ->join('stations','stations.station_id','=','groundNode.station_id')
                ->select('groundNode.station_id as station_id','stations.StationName as StationName')
                ->where('node_id',$source_id)->get();

                $data["source"]=$ground_node[0]->StationName."'s "."Ground Node";
                $data["station_id"]=$ground_node[0]->station_id;
            break;

            case "sensor":

            break;

            case "station":
                $station=DB::table('stations')
                ->select('StationName')
                ->where('station_id',$source_id)->get();

                $data["source"]=$station[0]->StationName."'s ";
                $data["station_id"]=$source_id;
            break;
        }

        return $data;
    }
}

<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use station\Http\Controllers\Controller;
use station\Http\Controllers\AnalyzerHandler;
use DateTimeZone;
use DateTime;

class NodeStatusAnalyzerController extends Controller
{
    private $Handler;
    /* txt col names for the different node tables */
    private $txt_2m_col_name;
    private $txt_10m_col_name;
    private $txt_gnd_col_name;
    private $txt_sink_col_name;
    /* variable to store the problem configurations for the different stations from the station_problem_settings table */
    private $stn_prb_conf;
    private $problemClassfications;
    /* variables to store table data for the different nodes */
    private $twoM_nd_data;
    private $tenM_nd_data;
    private $gnd_nd_data;
    private $sink_nd_data;

    public function __construct()
    {
        // dd('yey!');
        $this->Handler = new AnalyzerHandler();
        // dd(substr(($this->Handler->getCurrentDateTime())->format('Y-m-d H:m:s'),0,4));
        $this->txt_2m_col_name  = 'txt_2m_value';
        $this->txt_10m_col_name  = 'txt_10m_value';
        $this->txt_gnd_col_name  = 'txt_gnd_value';
        $this->txt_sink_col_name  = 'txt_sink_value';
        /**
         * PICK ALL THE DATA YOU'LL NEED
         * nodetype - twoMeterNode, tenMeterNode, groundNode, sinkNode 
         */
        

        // pick problem station configurations
        $this->problemClassfications = $this->Handler->getProblemClassifications();
        $this->stn_prb_conf = $this->Handler->getStationProbConfig();
        $this->twoM_nd_data = $this->Handler->getNodeTableData($this->txt_2m_col_name);
        $this->tenM_nd_data = $this->Handler->getNodeTableData($this->txt_10m_col_name);
        $this->gnd_nd_data = $this->Handler->getNodeTableData($this->txt_gnd_col_name);
        $this->sink_nd_data = $this->Handler->getNodeTableData($this->txt_sink_col_name);
    }

    /**
     * Function that is run
      */
    public function analyze()
    {
        // first clean DB
        // $this->Handler->cleanDBTable($this->Handler->getProbTbName());
        //get time diff to use for querying the db
        // $tasks = DB::table('observationslip')->where('CreationDate','>=',$this->getTimeDiff())
        // $date = $this->Handler->getTimeDiff();
        
        // store the first and last id checked  ->where()
        $id_first_checked = 0;
        $id_last_checked = 0;
        $counter = 0;
        $seq = -1;  
        
        $lastId = $this->Handler->getLastId('nodestatus');
        /* declare a collection to store the stations that sent data */
        $available_stations = array();
        /* declare a collection to store the nodes that sent data */
        $available_nodes = array(
            $this->Handler->getGndName() => array(),
            $this->Handler->get2mName() => array(),
            $this->Handler->get10mName() => array(),
            $this->Handler->getSinkName() => array()
        );
        // pick problem station configurations
        $stn_prb_conf = $this->stn_prb_conf;

        /* variables to store the used records */
        $V_MCU = '';
        $DATE = '';
        $TIME = '';
        
        // initialize variables with default values
        $criticality = 'Non Critical';// default criticality
        $max_track_counter = 12;// default criticality

        $node_data = collect();
        /* store the available nodes */
        /* $twoM_nodes = array();
        $tenM_nodes = array();
        $sink_nodes = array();
        $gnd_nodes = array();
        ,&$twoM_nodes,&$tenM_nodes,&$sink_nodes,&$gnd_nodes */
        
        // pick only columns that we'll be using since that will be faster. 
        // We need date_time_recorded to verify the date time sent by the node
        // ->get(500) at a time //'SEQ' - to track packet drops 173492
        DB::table($this->Handler->getNodeStatusTbName())->orderBy('id')->select('id','V_MCU','V_IN','date','time','TXT','date_time_recorded')->where('id','>',$lastId)->chunk(100, function($nodes) use(&$date, &$id_first_checked, &$id_last_checked, &$counter,&$seq,&$available_stations,&$available_nodes,&$V_MCU,&$DATE,&$TIME,&$node_data){
            
            foreach ($nodes as $node) {

                //store first id
                if ($id_first_checked === 0) {// ensure it's not yet set
                    $id_first_checked = $node->id;
                }
                //store last id checked
                $id_last_checked = $node->id;// keep overwritting to keep the last checked

                /* store node data */
                $node_data->put($node->TXT,['V_MCU' => $node->V_MCU, 'date' => $node->date, 'time' => $node->time]);

                $nd_id = '';
                $nd_name = '';
                $stn_id = '';
                $config_data = '';
                $nd_data = '';// variable to hold the array keys

                /* get correct config data */
                if (stripos($node->TXT, 'gnd') !== false) {
                    $config_data = $this->gnd_nd_data;
                    $nd_data = $this->Handler->getGndName();
                }
                elseif (stripos($node->TXT, '2m') !== false) {
                    $config_data = $this->twoM_nd_data;
                    $nd_data = $this->Handler->get2mName();
                }
                elseif (stripos($node->TXT, '10m') !== false) {
                    $config_data = $this->tenM_nd_data;
                    $nd_data = $this->Handler->get10mName();
                }
                elseif (stripos($node->TXT, 'sink') !== false) {
                    $config_data = $this->sink_nd_data;
                    $nd_data = $this->Handler->getSinkName();
                }
                
                /* if no configuration data was found then skip that record */
                if (empty($config_data)) {
                    continue;
                }

                $nodeInfo = $this->Handler->getNodeConfigurations($config_data,$node->TXT);
                $nd_id = $nodeInfo['nd_id'];
                $nd_name = $nodeInfo['nd_name'];
                $stn_id = $nodeInfo['stn_id'];
                /* store the node id if it isn't there already. search strictly */
                if ((array_search($nd_id, $available_nodes[$nd_data], true)) === false) {
                    array_push($available_nodes[$nd_data], $nd_id);
                }

                /* store the station id if it isn't there already. search strictly */
                if ((array_search($stn_id, $available_stations, true)) === false) {
                    array_push($available_stations, $stn_id);
                }
                // ------------------------------------------------------------------------------
                

                /* check for packet drops */
                /* if ($seq !== -1 && ( $seq !== ($node->SEQ + 1))) {
                    // check if there was a reset
                    if ($seq === 255 && $node->SEQ === 0) {
                        # do nothing..
                    }
                    else { // note down problem
                        $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"packets","dropped",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                    }
                } */
                
                $counter++;
            }// end of foreach

            // dd(array_unique($recorded_ids));
            // 

            //dd($counter);
            if ($counter === 500) { // check if max has been reached.
                return false; // stop chucking...
            }
        });// end of chunk
        // dd($available_nodes);
        // dd($available_stations);
        // dd($node_data);

        // $nodes_data = collect([
        //     $this->Handler->getGndName() => $gnd_nodes,
        //     $this->Handler->get2mName() => $twoM_nodes,
        //     $this->Handler->get10mName() => $tenM_nodes,
        //     $this->Handler->getSinkName() => $sink_nodes
        // ]);
        // dd($nodes   _data);
        /* twoM_nodes tenM_nodes sink_nodes gnd_nodes */

        /* check for missing nodes */
        $this->Handler->findMissingNodes($available_nodes,$criticality,$max_track_counter);

        $node_data->map(function($value, $key) use($stn_prb_conf,$criticality,$max_track_counter){

            /**
             * get the data about the station to which this data belongs 
             * station numbers have conflicts and so we shall use the txt value to determine the station from which the data is.
             */ 
            // dd($key);
            $TXT_VALUE = $key;
            $V_MCU = $value['V_MCU'];
            $date = $value['date'];
            $time = $value['time'];

            // dd($TXT_VALUE." - ".$V_MCU." - ".$date." - ".$time);

            $nd_id = '';
            $nd_name = '';
            $stn_id = '';
            $vmcuMaxVal = '';
            $config_data = '';
            $nd_data = '';// variable to hold the array keys
            $yearNow = substr(($this->Handler->getCurrentDateTime())->format('Y-m-d H:m:s'),0,4);
            $yearRec = substr($date,0,4);

            /* get correct config data */
            if (stripos($TXT_VALUE, 'gnd') !== false) {
                $config_data = $this->gnd_nd_data;
            }
            elseif (stripos($TXT_VALUE, '2m') !== false) {
                $config_data = $this->twoM_nd_data;
            }
            elseif (stripos($TXT_VALUE, '10m') !== false) {
                $config_data = $this->tenM_nd_data;
            }
            elseif (stripos($TXT_VALUE, 'sink') !== false) {
                $config_data = $this->sink_nd_data;
            }
            
            /* if no configuration data was found then skip that record */
            if ($config_data === '') {
                return $value;
            }

            $nodeInfo = $this->Handler->getNodeConfigurations($config_data,$TXT_VALUE);
            $nd_id = $nodeInfo['nd_id'];
            $nd_name = $nodeInfo['nd_name'];
            $stn_id = $nodeInfo['stn_id'];
            $vmcuMaxVal = $nodeInfo['vmcuMaxVal'];
            $vmcuMinVal = $nodeInfo['vmcuMinVal'];

            //check for nulls                
            if (empty($V_MCU)) {
                // get problem
                $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Node","missing",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                
            }                     
            elseif ($V_MCU < $vmcuMinVal) {// check for mins   

                $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Node power","below range",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                
            }
            /* check if there were no problems in which case we decrement the counter for the problem if they had been recorded before */
            if (!empty($V_MCU)) {
                $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Node","missing",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'removeproblem');
            }
            if ($V_MCU >= $vmcuMinVal) {
                
                $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Node power","below range",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'removeproblem');
            }
            
            /* if (empty($date)) { // this problem has been ignored for now

                $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Date","missing",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                
            }   */ 
            if (strcasecmp($yearRec, $yearNow) == 0) {// then dates are equal
                /* consider time diff */
                /* if () {
                    $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Date","incorrect",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                } */

            }
            else {
                $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Date","incorrect",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
            }        
            // check for maxs        
            /* if ($V_MCU > $vmcuMaxVal) { // ignored for now

                $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Node power","above range",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                
            } */
            return $value;
        });

        $no_of_recs = $id_last_checked - $id_first_checked + 1;
        if ($no_of_recs === 1) {
            $no_of_recs = 0;
        }

        if ($id_last_checked === 0) {
            $id_last_checked = $lastId;
        }
        // update last check table
        $this->Handler->updateChecksTable('nodestatus',$id_first_checked,$id_last_checked);

        /* call observationslip analyzer */
        app('station\Http\Controllers\ObservationSlipAnalyzerController')->analyze($available_stations);

        //show data in the problems table
        return;
        /* return redirect('/probTbData')->with([
            'flash_message' => 'Analyzed '. $no_of_recs .' records'
        ]); */
    }
}

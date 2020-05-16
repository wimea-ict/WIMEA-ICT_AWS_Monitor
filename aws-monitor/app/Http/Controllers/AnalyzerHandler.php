<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use station\Http\Controllers\Controller;
use DateTimeZone;
use DateTime;
use ChannelLog as Log;

class AnalyzerHandler extends Controller
{
    //
    private $problem_classifn_tb;
    private $stns_tb;
    private $statn_prob_sttngs_tb;
    private $ndStatus_tb;
    private $observSlp_tb;
    private $prob_tb;
    private $sensors_tb;
    private $gnd_nd_tb;
    private $twoM_nd_tb;
    private $tenM_nd_tb;
    private $sink_nd_tb;
    private $timezone;
    /* names used to identify the table name of the nodes */
    private $gnd_name;
    private $sink_name;
    private $towN_name;
    private $tenN_name;

    public function __construct() {
        $this->problem_classifn_tb = 'problem_classification';
        $this->stns_tb = 'stations';
        $this->statn_prob_sttngs_tb = 'station_problem_settings';
        $this->prob_tb = 'problems';
        $this->sensors_tb = 'sensors';
        $this->ndStatus_tb = 'nodestatus';
        $this->observSlp_tb = 'observationslip';
        $this->gnd_nd_tb = 'groundNode';
        $this->twoM_nd_tb = 'twoMeterNode';
        $this->tenM_nd_tb = 'tenMeterNode';
        $this->sink_nd_tb = 'sinkNode';
        $this->timezone = 'Africa/Kampala';
        // nodetype - twoMeterNode, tenMeterNode, groundNode, sinkNode
        $this->gnd_name = 'groundNode';
        $this->towN_name = 'twoMeterNode';
        $this->tenN_name = 'tenMeterNode';
        $this->sink_name = 'sinkNode';
    }

    /**
     * get current date
     */
    public function getCurrentDateTime()
    {
        $zone = new DateTimeZone($this->timezone);// set timezone
        $date = new DateTime("now", $zone);// get current time
        
        return $date;
    }

    /**
     * Get time difference to use when quering the node_status table
     */
    public function getTimeDiff()
    {
        // "date_time_recorded": "2018-02-28 15:40:19"
        $date = $this->getCurrentDateTime();// get current time
        // $date->sub(new DateInterval('PT1H'));// subtract one hour from current time
        $date = $date->format('Y-m-d H:m:s');// change date time object to string format used in the database.
        return $date;
    }

    public function getProbTbName()
    {
        return $this->prob_tb;
    }

    public function get2mName()
    {
        return $this->towN_name;
    }

    public function get10mName()
    {
        return $this->tenN_name;
    }

    public function getGndName()
    {
        return $this->gnd_name;
    }

    public function getSinkName()
    {
        return $this->sink_name;
    }
    

    public function getObservationSlipTbName()
    {
        return $this->observSlp_tb;
    }

    public function getNodeStatusTbName()
    {
        return $this->ndStatus_tb;
    }

    /**
     * getProblemClassifications()
     * gets all the problem classifications in the table
     * @returns $problemClassfications
     */
    public function getProblemClassifications(){
        $problemClassfications = DB::table($this->problem_classifn_tb)->select('id','problem_description','source')->get();
        return $problemClassfications;
    }
    /**
     * getProblemClassification()
     * gets the problem description for the given id
     * @returns $prob_description
     */
    public function getProblemClassfctn($id){
        // dd($id);
        $prob = DB::table($this->problem_classifn_tb)->select('problem_description')->where('id','=',$id)->get();
        $prob->toArray();
        // dd($prob);
        // dd($prob[0]->problem_description);
        return $prob[0]->problem_description;
    }

    /**
     * getStations();
     * @returns $stations
     */
    public function getStations(){
        $stations = DB::table($this->stns_tb)->select('station_id', 'StationName', 'StationNumber')->get();
        return $stations;
    }
    
    /**
     *  getStationName($stn_id)
     *  @param stn_id
     * @returns $station_name;
     */
    public function getStationName($stn_id){
        $station_name = '';
        $stations = $this->getStations(); 
        // dd($stn_id);
        // dd($stations);
        $counter = 0;
        foreach ($stations as $station) {
            $counter++;
            // dd($station->station_id . " - " . $stn_id);
            if ($station->station_id == $stn_id) {
                // dd('here');
                $station_name = $station->StationName;
                // dd($station_name . " - " . $stn_id);
                // break;
            }
        }
        
        // dd($station_name . " - " . $stn_id . " -counter " . $counter . " - " . $stations->count());
        return $station_name;
    }

    /**
     * This method returns a node
     */
    public function getNode($nodeType, $nd_id)
    {
        $node_data = '';
        
        // dd(" node ". $nodeType." - ". $nd_id);    
        if (stripos($nodeType, $this->towN_name) !== false) { 
            
            $node_data = DB::table($this->twoM_nd_tb)->select('node_id','station_id')->where('node_id','=',$nd_id)->get();
        }
        elseif (stripos($nodeType, $this->tenN_name) !== false) {

            $node_data = DB::table($this->tenM_nd_tb)->select('node_id','station_id')->where('node_id','=',$nd_id)->get();
        }
        elseif (stripos($nodeType, $this->gnd_name) !== false) {

            $node_data = DB::table($this->gnd_nd_tb)->select('node_id','station_id')->where('node_id','=',$nd_id)->get();
        }
        elseif (stripos($nodeType, $this->sink_name) !== false) {

            $node_data = DB::table($this->sink_nd_tb)->select('node_id','station_id')->where('node_id','=',$nd_id)->get();
        }
        // dd($node_data);    
        return $node_data;
    }

    /**
     * This method returns a sensor with its a station id
     */
    public function getSensor($sensor_id,$nodeType)
    {
        $node_data = '';
        //  dd(" sensor ". $sensor_id." - ". $nodeType);    
        $sensors = DB::table($this->sensors_tb)->select('id','node_id','node_type','parameter_read')->where([
            ['id','=',$sensor_id],
        ])->get();
        // dd($sensors);
        
        /* map enabled sensors to enabled nodes */
        $sensors->transform(function($sensor) use($node_data){
            $node_data = $this->getNode($sensor->node_type, $sensor->node_id);
            // dd($node_data);
            foreach ($node_data as $data) {
                $sensor->station_id = $data->station_id;
                return $sensor;
            }
        });
        
        /* remove nulls */
        $sensors = $sensors->reject(function($sensor){
            return $sensor === null;
        });
        // dd($sensors);

        return $sensors;
    }

    /**
     * This method returns sensors with its a station id
     */
    public function getSensors()
    {
        /* variable to hold all enabled sensors */
        $Sensors = collect();        
        /**
         * $sensors_tb
         * get corresponding sensors
         * nodetype - twoMeterNode, tenMeterNode, groundNode, sinkNode
         */
        /* create array to loop through node type and get all sensors */
        $nodeTypes = collect([
            $this->gnd_name,
            $this->towN_name,
            $this->tenN_name,
            $this->sink_name
        ]);
        // dd($nodeTypes);

        foreach ($nodeTypes as $nodeType) {
            // dd($nodeType); //'node_id','node_type','parameter_read'
            $sensors = DB::table($this->sensors_tb)->select('id','node_id','node_type','parameter_read')->where([
                ['node_type','=',$nodeType]
            ])->get();
            // dd($sensors);
            /**
             * $gnd_nd_tb, $twoM_nd_tb, $tenM_nd_tb, $sink_nd_tb
             * node tables - twoMeterNode, tenMeterNode, sinkNode, groundNode,
            */
            $node_data = $this->getNodesByNodeType($nodeType);
            // dd($node_data);
            /* check if any nodes were returned */
            /* if (empty($node_data)) {
                //  if no nodes were returned then no sensors should be considered enabled 
                $sensors = '';
            } */

            if (!empty($sensors)) {
                // dd($node_data);
                /* map enabled sensors to enabled nodes */
                $sensors->transform(function($sensor) use($node_data){
                    foreach ($node_data as $data) {
                        if ($data->node_id === $sensor->node_id) {
                            /* assign station_id to sensors whose nodes are enabled */
                            $sensor->station_id = $data->station_id;
                            return $sensor;
                        }
                    }
                });
                
                /* remove nulls */
                $sensors = $sensors->reject(function($sensor){
                    return $sensor === null;
                });
                // dd($sensors);
                /* add sensor to collection */
                $Sensors = $Sensors->concat($sensors);
            }
        }
        
        // dd($Sensors);
        return $Sensors;
    }

    /**
     * 
     */
    public function problemStationNames($source, $source_id)
    {
        $stn_name = '';
        $stn = 'station';
        $sensor = 'sensor';
        $twoM = 'twoMeterNode';
        $tenM = 'tenMeterNode';
        $gnd = 'groundNode';
        $sink = 'sinkNode';
        $parameter_read = '';
        // dd($source . "-". $source_id);
        if (stripos($source, $stn) !== false) {
            $stn_name = $this->getStationName($source_id);
            // dd($this->getStationName(10));
            // dd($stn_name . " - " . $source_id);
        }
        elseif (stripos($source, $sensor) !== false) {
            $sensor = $this->getSensor($source_id,$source);
            foreach ($sensor as $sens) {
                $stn_name = $this->getStationName($sens->station_id);
                // dd($stn_name . " - " . $source_id);
                $parameter_read = $sens->parameter_read;
                break;
            }
        }
        elseif (stripos($source, $twoM) !== false) {
            $node = $this->getNode($source, $source_id);
            foreach ($node as $nd) {
                $stn_name = $this->getStationName($nd->station_id);
                break;
            }
        }
        elseif (stripos($source, $tenM) !== false) {
            $node = $this->getNode($source, $source_id);
            foreach ($node as $nd) {
                $stn_name = $this->getStationName($nd->station_id);
                break;
            }
        }
        elseif (stripos($source, $gnd) !== false) {
            $node = $this->getNode($source, $source_id);
            foreach ($node as $nd) {
                $stn_name = $this->getStationName($nd->station_id);
                break;
            }
        }
        elseif (stripos($source, $sink) !== false) {
            $node = $this->getNode($source, $source_id);
            foreach ($node as $nd) {
                $stn_name = $this->getStationName($nd->station_id);
                break;
            }
        }

        //  dd($stn_name);    
        return array(
            "stn_name" => $stn_name,
            "parameter_read" => $parameter_read
        );
    }

    /**
     * pick problem station configurations
     * @returns $stn_prb_conf;
     */
    public function getStationProbConfig(){
        
        // problem_id, station_id, max_track_counter, criticality where('station_id',$stn_id)->
        $stn_prb_conf = DB::table($this->statn_prob_sttngs_tb)->select('station_id','problem_id','max_track_counter','criticality')->get();

        return $stn_prb_conf;
    }

    /**
     * get all the data in node table
     */
    public function getNodeData($nd_tb_name, $txt_col_name)
    {
        $node_tb = DB::table($nd_tb_name)->select('node_id','station_id',$txt_col_name,'v_in_max_value','v_in_min_value','v_mcu_max_value','v_mcu_min_value')->get();
        
        return $node_tb;
    }

    /**
     * 
     */
    public function getNodeTableData($txt_col_name)
    {

        $tb_data = '';
        /* 'sensor','station','2m_node','10m_node','sink_node','ground_node' */
        if (stripos($txt_col_name, 'gnd') !== false) {
            // node_id, station_id, txt_gnd_value
            $tb_data = $this->getNodeData($this->gnd_nd_tb,'txt_gnd_value');
            
        }
        else if (stripos($txt_col_name, '2m') !== false) {
            // node_id, station_id, txt_2m_value
            $tb_data = $this->getNodeData($this->twoM_nd_tb,'txt_2m_value');
            
        }
        else if (stripos($txt_col_name, '10m') !== false) {
            // node_id, station_id, txt_10m_value
            $tb_data = $this->getNodeData($this->tenM_nd_tb,'txt_10m_value');
            
        }
        else if (stripos($txt_col_name, 'sink') !== false) {
            // node_id, station_id, txt_sink_value
            $tb_data = $this->getNodeData($this->sink_nd_tb,'txt_sink_value');
            
        }

        return $tb_data;
    }

    /**
     * getNodeConfigurations()
     * it also gets the node configurations
     * @returns array of values
     * Get the respective node ids
     * node name:- '2m_node','10m_node','sink_node','ground_node'
     * this should be separated into its own function
     * the txt identifiers should be stated as variables to manage them as they change
     * Since only configured nodes are saved to the database, there shouldn't be an unassigned variable.
     */
    public function getNodeConfigurations($config_data, $txt){

        
        $nd_id = '';
        $nd_name = '';
        $stn_id = '';
        $vinMaxVal = '';
        $vinMinVal = '';
        $vmcuMaxVal = '';
        $vmcuMinVal = '';
        $node_tb = $config_data;
        /* 'sensor','station','2m_node','10m_node','sink_node','ground_node' */
        if (stripos($txt, 'gnd') !== false) {
            // look up node config in the table data
            foreach ($node_tb as $nd_tb) {
                if ($nd_tb->txt_gnd_value === $txt) {
                    $stn_id = $nd_tb->station_id;
                    $nd_id = $nd_tb->node_id;
                    $nd_name = $this->gnd_name;
                    $vinMaxVal = $nd_tb->v_in_max_value;
                    $vinMinVal = $nd_tb->v_in_min_value;
                    $vmcuMaxVal = $nd_tb->v_mcu_max_value;
                    $vmcuMinVal = $nd_tb->v_mcu_min_value;
                    break;
                }
            }
        }
        else if (stripos($txt, '2m') !== false) {
            // look up node config in the table data
            foreach ($node_tb as $nd_tb) {
                if ($nd_tb->txt_2m_value === $txt) {
                    $stn_id = $nd_tb->station_id;
                    $nd_id = $nd_tb->node_id;
                    $nd_name = $this->towN_name;
                    $vinMaxVal = $nd_tb->v_in_max_value;
                    $vinMinVal = $nd_tb->v_in_min_value;
                    $vmcuMaxVal = $nd_tb->v_mcu_max_value;
                    $vmcuMinVal = $nd_tb->v_mcu_min_value;
                    break;
                }
            }
        }
        else if (stripos($txt, '10m') !== false) {
            // look up node config in the table data
            foreach ($node_tb as $nd_tb) {
                if ($nd_tb->txt_10m_value === $txt) {
                    $stn_id = $nd_tb->station_id;
                    $nd_id = $nd_tb->node_id;
                    $nd_name = $this->tenN_name;
                    $vinMaxVal = $nd_tb->v_in_max_value;
                    $vinMinVal = $nd_tb->v_in_min_value;
                    $vmcuMaxVal = $nd_tb->v_mcu_max_value;
                    $vmcuMinVal = $nd_tb->v_mcu_min_value;
                    break;
                }
            }
        }
        else if (stripos($txt, 'sink') !== false) {
            // look up node config in the table data
            foreach ($node_tb as $nd_tb) {
                if ($nd_tb->txt_sink_value === $txt) {
                    $stn_id = $nd_tb->station_id;
                    $nd_id = $nd_tb->node_id;
                    $nd_name = $this->sink_name;
                    $vinMaxVal = $nd_tb->v_in_max_value;
                    $vinMinVal = $nd_tb->v_in_min_value;
                    $vmcuMaxVal = $nd_tb->v_mcu_max_value;
                    $vmcuMinVal = $nd_tb->v_mcu_min_value;
                    break;
                }
            }
        }
        
        return array(
            'stn_id' => $stn_id, 
            'nd_id' => $nd_id, 
            'nd_name' => $nd_name, 
            'vinMaxVal' => $vinMaxVal, 
            'vinMinVal' => $vinMinVal, 
            'vmcuMaxVal' => $vmcuMaxVal, 
            'vmcuMinVal' => $vmcuMinVal, 
        );
    }

    /**
     * Resetting a table
     * @param $tb_name
     */
    public function cleanDBTable($tb_name)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($tb_name)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return;
    }

    /**
     * writes problem to log file
     */
    public function logProblem($prob_id, $source, $source_id, $status)
    {
        /* prepare and write log to file */
        $prob_data =  $this->problemStationNames($source, $source_id);
        $stn_name = $prob_data['stn_name'];
        $parameter_read = $prob_data['parameter_read'];
        $source_description = '';
        if(!empty($parameter_read)){
            $source_description = $stn_name ." :: ". $parameter_read ." - ". $source;
        }
        else {
            $source_description = $stn_name ." :: ". $source;
        }
        $prob_descrptn = $this->getProblemClassfctn($prob_id);
        // dd($prob_descrptn);
        // (writes INFO to logs/problem.log)  
        /* Syntax:- Log::write('file-to-write-to', 'prob-classification','$source_description','prob-status'); */
        Log::write('problem', $prob_descrptn, ['source'=>$source_description, 'status'=>$status]);

        return;
    }

    /**
     * Insert data into problem table     
     * @param $nd_id, 
     * @param $nd_name, 
     * @param $prob_id, 
     * @param $criticality
     * @return null
     */
    public function insertIntoProbTb($source_id, $source, $prob_id, $criticality)
    {
        /*
         * Field        possible values
         * id
         * source       ('sensor','station','2m_node','10m_node','sink_node','ground_node')
         * source_id
         * criticality  ('critical', 'non-critical')
         * classification_id
         * track_counter
         * status       ('reported', 'investigation', 'solved')
         * created_at
         * updated_at
         */
        DB::table($this->prob_tb)->insert(
            ['source'=>$source,'source_id'=>$source_id,'criticality'=>$criticality,'classification_id'=>$prob_id,'track_counter'=>1,'status'=>'investigation', 'created_at'=>$this->getCurrentDateTime()]
        );

        //log the problem into a file
        $this->logProblem($prob_id, $source, $source_id, 'investigation');

        return;
    }

    /**
     * search problems table and return problems not yet solved
     * @return problem
     * it excludes the solved problems and so should return only one record
     * this is because we don't record a problem again before it has been solved.
     */
    public function getProblem($id,$source,$classification_id)
    {
        // id, source_id, track_counter
        $prob = DB::table($this->prob_tb)->select('id','source_id','track_counter','status')->where([
            ['source_id','=',$id],
            ['source','=',$source],
            ['status','<>','solved'],
            ['classification_id','=',$classification_id],
        ])->get();
        
        return $prob;
    }

    /**
     * update problem 
     */
    public function updateProblem($prob_track_counter, $max_track_counter, $prob_status, $prob_id, $prob_action, $source, $source_id, $problem_id)
    {
        /* first check for requested problem action */
        if (stripos($prob_action, 'removeproblem') !== false) {
            // check if track counter was already equal to zero we set the set the status to solved. This could have happened incase the previous iteration failed to update the status for some reason...
            if (($prob_track_counter) <= 0) {
                // update status to solved
                DB::table($this->prob_tb)->where('id',$prob_id)->update(['status'=>'solved']);
                return;// exit method
            }
            // check if max_counter had already been reached to avoid incrementing it again. This could have happened incase the previous iteration failed to update the status for some reason...
            if (($prob_track_counter) >= $max_track_counter && $prob_status !== 'reported') {
                // update status to solved
                DB::table($this->prob_tb)->where('id',$prob_id)->update(['status'=>'reported']);
            }

            // decrement counter of the problem
            DB::table($this->prob_tb)->where('id',$prob_id)->decrement('track_counter');

            // update the updated_at column to record when the problem wasn't encountered again            
            DB::table($this->prob_tb)->where('id',$prob_id)->update(['updated_at'=>$this->getCurrentDateTime()]);
            
            // check if counter has reached zero in which case the status has to be changed to solved
            if (($prob_track_counter - 1) <= 0) {
                // update status to reported
                DB::table($this->prob_tb)->where('id',$prob_id)->update(['status'=>'solved']);
            }
        } 
        elseif (stripos($prob_action, 'solveproblem') !== false) {
            // set status to solved
            DB::table($this->prob_tb)->where('id',$prob_id)->update(['status'=>'solved']);
            return;// exit method
        } 
        elseif (stripos($prob_action, 'addproblem') !== false)  {
            // check if max_counter had already been reached to avoid incrementing it again. This could have happened incase the previous iteration failed to update the status for some reason...
            if ($prob_track_counter >= $max_track_counter && $prob_status !== 'reported') {
                // update status to solved
                DB::table($this->prob_tb)->where('id',$prob_id)->update(['status'=>'reported']);
            }

            // if already at max, don't increment
            if ($prob_status === 'reported' && $prob_track_counter >= $max_track_counter) {
                // update the updated_at column to record when the problem was encountered again
                DB::table($this->prob_tb)->where('id',$prob_id)->update(['updated_at'=>$this->getCurrentDateTime()]);
            }
            else {
                // increment the counter
                DB::table($this->prob_tb)->where('id',$prob_id)->increment('track_counter');

                // update the updated_at column to record when the problem was encountered again
                DB::table($this->prob_tb)->where('id',$prob_id)->update(['updated_at'=>$this->getCurrentDateTime()]);

                // check if max_counter has been reached and if so change status and call the reporter.
                if (($prob_track_counter + 1) >= $max_track_counter) {
                    // update status to reported
                    DB::table($this->prob_tb)->where('id',$prob_id)->update(['status'=>'reported']);
                }
            } 

            // log the problem into a file
            $this->logProblem($problem_id, $source, $source_id, 'investigation');
        }   
        
        return;
    }

    /**
     * 
     * @param $prob_action - this variable is used to determine if we're decrementing the counter or incrementing it
     */
    public function registerProblem($source_id, $source, $problem_id, $criticality, $max_track_counter,$prob_action)
    {
        // check data in the problems table to see if problem has been reported yet.
        $prob = $this->getProblem($source_id,$source,$problem_id); 
        
        if ($prob->isEmpty()) {
            /* check problem action, a decrement means that we  */
            if (stripos($prob_action, 'addproblem') !== false) {
                /**
                 * record doesn't exit in the database and so...
                 * insert into the the problem into the database
                 * at this point, we get the criticality of this problem
                 */
                $this->insertIntoProbTb($source_id, $source, $problem_id, $criticality);
            }
            
        }
        else {
            /**
             * $source_id, $source, $problem->id, $criticality, $max_track_counter
             * problem exists
             * if problem is not yet reported, then increment the counter
             * after increment, check if the counter has reached max, if so, call the reporter and then set the status to reported.
             * if status is reported, then just update the 'updated_at' column to show that the problem was realised
             */

            $prob = $prob->toArray();
            // $source, $source_id
            $this->updateProblem($prob[0]->track_counter, $max_track_counter, $prob[0]->status,$prob[0]->id, $prob_action, $source, $source_id, $problem_id);
        }
    }

    /**
     * @param $nd_id
     * @param $nd_name
     * @param $problemClassfications
     * @param $param - "V_IN,V_MCU,..." paramaters being checked
     * @param $prob - "empty, null,..." any anormally being checked
     * @param $stn_prb_conf - the station configurations 
     * @param $criticality
     * @param $max_track_counter
     * @param $stn_id
     * @param $prob_action - this variable is used to determine if we're decrementing the counter or incrementing it
     */
    public function checkoutProblem($source_id,$source,$problemClassfications,$param,$prob,$stn_prb_conf,$criticality,$max_track_counter,$stn_id,$prob_action)
    {
        // dd($problemClassfications);
        // if ($source_id === 15) {
        //     dd($source);
        // }
        // get problem
        foreach ($problemClassfications as $problem) {
            // do a case insensitive check
            if (stripos($problem->problem_description, $param) !== false) {
                if (stripos($problem->problem_description, $prob) !== false) {
                    /**
                     * getting the problem criticality and prob_max_counter
                     */
                    if ($stn_prb_conf->isNotEmpty()) {
                        foreach ($stn_prb_conf as $prb_conf) {
                            if ($prb_conf->station_id === $stn_id) {
                                if ($prb_conf->problem_id === $problem->id) {
                                    // $criticality = $prb_conf->criticality;
                                    // $max_track_counter = $prb_conf->max_track_counter;
                                    // dd($source_id." - ". $source, $problem->id." - ". $criticality." - ". $max_track_counter." - ".$prob_action);
                                    $this->registerProblem($source_id, $source, $problem->id, $prb_conf->criticality, $prb_conf->max_track_counter,$prob_action);  
                                    // break;
                                    return;// return the problem
                                }
                            }                            
                        }                                      
                        break;
                    }                    
                }
            }
        }
        // if problem is not found, return nothing
        return;
    }

    /**
     * check table to be checked for last check details...
     * @param $data
     */
    public function getLastId($data)
    {
        if (strcasecmp($data,'observationslip') == 0) {
            $checks = DB::table('observtnslp_analyzer_checks')->orderBy('id','desc')->first();
            if (empty($checks->id_last_checked)) {
                return -1;
            }
            else {
                return $checks->id_last_checked;
            }
        }
        elseif (strcasecmp($data,'nodestatus') == 0) {
            $checks = DB::table('nodestatus_analyzer_checks')->orderBy('id','desc')->first();
            if (empty($checks->id_last_checked)) {
                return -1;
            }
            else {
                return $checks->id_last_checked;
            }
        }        
        return -1;
    }

    /**
     * Function to update the check table
     * @param $data - 
     * @param $id_first_checked - 
     * @param $id_last_checked - 
     */
    public function updateChecksTable($data,$id_first_checked,$id_last_checked)
    {
        if (strcasecmp($data,'nodestatus') == 0) {
            
            DB::table('nodestatus_analyzer_checks')->insert(
                ['id_first_checked'=>$id_first_checked,'id_last_checked'=>$id_last_checked]
            );
        }
        elseif (strcasecmp($data,'observationslip') == 0) {
            
            DB::table('observtnslp_analyzer_checks')->insert(
                ['id_first_checked'=>$id_first_checked,'id_last_checked'=>$id_last_checked]
            );
        }
    }

    /**
     * Function used only by class
     */
    private function getSensorDetails($nodeType, $nodeTable)
    {
        /**
         * $sensors_tb
         * get corresponding sensors
         * nodetype - twoMeterNode, tenMeterNode, groundNode, sinkNode
         */

        // dd($nodeType);
        $sensors = DB::table($this->sensors_tb)->select('id','node_id','node_type','sensor_status','parameter_read','min_value','max_value')->where('node_type','=',$nodeType)->get();
        // dd($sensors);
        /**
         * $gnd_nd_tb, $twoM_nd_tb, $tenM_nd_tb, $sink_nd_tb
         * node tables - twoMeterNode, tenMeterNode, sinkNode, groundNode,
        */
        $nodes = DB::table($nodeTable)->select('node_id','station_id','node_status')->get();

        // dd($nodes);
        /**
         * map the sensors to the stations
         * any sensor that fails to map to a station will be turned to a null and will thus be ignored.
         */
        $sensors->transform(function($sensor) use($nodes){
            foreach ($nodes as $node) {                
                if ($node->node_id === $sensor->node_id) {
                    /* add station_id value to the collection */
                    $sensor->station_id = $node->station_id;
                    return $sensor;
                }
            }
        });
        /**
         * remove nulls
         */
        $sensors = $sensors->reject(function($sensor){
            return $sensor === null;
        });
        return $sensors;
    }

    /**
     * 
     */
    public function getSensorConfigInfo($nodeType)
    {
        $data = '';
        //dd($nodeType);
        /**
         * nodetype - twoMeterNode, tenMeterNode, groundNode, sinkNode 
         * $gnd_nd_tb, $twoM_nd_tb, $tenM_nd_tb, $sink_nd_tb
         * node tables - twoMeterNode, tenMeterNode, sinkNode, groundNode,
        */
        if (stripos($nodeType, 'twoMeterNode') !== false) { 
            
            $data = $this->getSensorDetails('twoMeterNode', $this->twoM_nd_tb);
        }
        elseif (stripos($nodeType, 'tenMeterNode') !== false) {
            
            $data = $this->getSensorDetails('tenMeterNode', $this->tenM_nd_tb);
        }
        elseif (stripos($nodeType, 'groundNode') !== false) {

            $data = $this->getSensorDetails('groundNode', $this->gnd_nd_tb);
        }
        elseif (stripos($nodeType, 'sinkNode') !== false) {
            
            $data = $this->getSensorDetails('sinkNode', $this->sink_nd_tb);
        }
        
        return $data;
    }

    /**
     * @param $sensor_data, 
     * @param $station_id, 
     * @param $parameter_read,
     * @param $rec_value
     * @param $problem - "missing, incorrect
     * @param $sensor_id, 
     * @param $problemClassfications, 
     * @param $stn_prb_conf, 
     * @param $criticality, 
     * @param $max_track_counter
     */
    public function analyzeSensorData($available_sensor_data, $station_id, $parameter_read, $rec_value, $problemClassfications, $stn_prb_conf, $criticality, $max_track_counter, $sensor_id)
    {
        // $sensors_available = $this->getSensors();
        // dd('hold it right here! - '.$parameter_read. ' stn id - '. $station_id . "\n". $available_sensors);
        foreach ($available_sensor_data as $data) {
            /**
             * min_value, max_value 
             * parameter_read - relative humidity(2mnd), Temperature(2mnd), insulation(10mnd), wind speed(10mnd), wind direction(), preciptation(gndnd), soil moisture(gnd), soil temperature(gnd), pressure(sinknd)536738
             */
            // if ($parameter_read !== 'wind direction' && $parameter_read !== 'pressure') {
            /* if ($station_id === 16 ) {
                dd('hold it right here! - '.$parameter_read. ' stn id - '. $station_id . "\n". $sensor_data);
            } */
            if ($data->station_id === $station_id) {
                // dd('hold it right here! - '.$parameter_read. ' stn id - '. $station_id);
                if (stripos($data->parameter_read, $parameter_read) !== false) {
                    // $sensor_id = -1;
                    // /* get sensor id */
                    // // 'id','node_id','node_type','parameter_read', 'station_id'
                    // foreach ($sensors_available as $sensor) {
                    //     if ($sensor->station_id === $station_id && $sensor->parameter_read === $parameter_read ) {
                    //         $sensor_id = $sensor->id;
                    //         break;
                    //     }
                    // }
                    // dd('hold it right here! - '.$parameter_read. ' stn id - '. $station_id);
                    // dd(preg_match("/[a-z]/i", "Cats are fun. I like cats."));
                    if (preg_match("/[a-z]/i", $rec_value) === 1) {// check for hexadecimals
                        # then value is less than minimum
                        $this->checkoutProblem($sensor_id,'sensor',$problemClassfications,"sensor","incorrect",$stn_prb_conf,$criticality,$max_track_counter,$station_id,"addproblem");
                        // dd('hold it right here! - '.$parameter_read. ' stn id - '. $station_id);
                        break;// exit loop
                    }
                    elseif ($rec_value < $data->min_value) {
                        # then value is less than minimum
                        $this->checkoutProblem($sensor_id,'sensor',$problemClassfications,"sensor","below range",$stn_prb_conf,$criticality,$max_track_counter,$station_id,"addproblem");
                        // dd('hold it right here! - '.$parameter_read. ' stn id - '. $station_id);
                        break;// exit loop
                    }
                    elseif ($rec_value > $data->max_value) {
                        # then value is greater than maximum
                        $this->checkoutProblem($sensor_id,'sensor',$problemClassfications,"sensor","above range",$stn_prb_conf,$criticality,$max_track_counter,$station_id,"addproblem");
                        // dd('hold it right here! - '.$parameter_read. ' stn id - '. $station_id);
                        break;// exit loop
                    }

                    if (preg_match("/[a-z]/i", $rec_value) === 0) {// check for hexadecimals
                        # then value is less than minimum
                        $this->checkoutProblem($sensor_id,'sensor',$problemClassfications,"sensor","incorrect",$stn_prb_conf,$criticality,$max_track_counter,$station_id,"removeproblem");
                        // dd('hold it right here! - '.$parameter_read. ' stn id - '. $station_id);
                        break;// exit loop
                    }
                    elseif ($rec_value >= $data->min_value) {
                        # then value is less than minimum
                        $this->checkoutProblem($sensor_id,'sensor',$problemClassfications,"sensor","below range",$stn_prb_conf,$criticality,$max_track_counter,$station_id,"removeproblem");
                        // dd('hold it right here! - '.$parameter_read. ' stn id - '. $station_id);
                        break;// exit loop
                    }
                    elseif ($rec_value <= $data->max_value) {
                        # then value is greater than maximum
                        $this->checkoutProblem($sensor_id,'sensor',$problemClassfications,"sensor","above range",$stn_prb_conf,$criticality,$max_track_counter,$station_id,"removeproblem");
                        // dd('hold it right here! - '.$parameter_read. ' stn id - '. $station_id);
                        break;// exit loop
                    }
                }
            }
            
        }
    }

    /**
     * 
     */
    public function getSensorId($sensors_available, $parameter_read, $station_id)
    {
        $sensor_id = -1;
        // dd($sensors_available);//  && 
        // dd($parameter_read . " - " .$station_id);
        /* get sensor id */
        // 'id','node_id','node_type','parameter_read', 'station_id'
        foreach ($sensors_available as $sensor) {
            // dd($parameter_read . " - " .$station_id); 
            if ($sensor->station_id === $station_id && $sensor->parameter_read === $parameter_read) {
                // dd($parameter_read . " - " .$station_id); 
                $sensor_id = $sensor->id;
                break;
            }
        }
        return $sensor_id;
    }

    /**
     * This method returns all stations with a status of on
     */
    public function getEnabledSations($status)
    {
        return DB::table($this->stns_tb)->select('station_id')->where([
            ['StationStatus','=',$status],
            ['stationCategory','=','aws'],
        ])->get();
    }

    /**
     * This method returns the enabled nodes from the enabled stations
     */
    public function getEnabledNodes($nodeType, $status)
    {
        $node_data = '';
        /**
         * nodetype - twoMeterNode, tenMeterNode, groundNode, sinkNode 
         * $gnd_nd_tb, $twoM_nd_tb, $tenM_nd_tb, $sink_nd_tb
         * node tables - twoMeterNode, tenMeterNode, sinkNode, groundNode,
        */
        
        // dd($nodeType);
        if (stripos($nodeType, $this->towN_name) !== false) { 
            
            $node_data = DB::table($this->twoM_nd_tb)->select('node_id','station_id')->where('node_status','=',$status)->get();
        }
        elseif (stripos($nodeType, $this->tenN_name) !== false) {

            $node_data = DB::table($this->tenM_nd_tb)->select('node_id','station_id')->where('node_status','=',$status)->get();
        }
        elseif (stripos($nodeType, $this->gnd_name) !== false) {

            $node_data = DB::table($this->gnd_nd_tb)->select('node_id','station_id')->where('node_status','=',$status)->get();
        }
        elseif (stripos($nodeType, $this->sink_name) !== false) {

            $node_data = DB::table($this->sink_nd_tb)->select('node_id','station_id')->where('node_status','=',$status)->get();
        }

        // dd($node_data);

        $stn_data = $this->getEnabledSations("on");

        // dd($stn_data);
        /* check if no stations were returned */
        if (empty($stn_data)) { 
            /* if no stations were returned then no nodes are enabled */
            $node_data = '';
        }

        /* check if no nodes were returned */
        if (!empty($node_data)) {
            /* map enabled nodes to enabled stations */
            $node_data->transform(function($node) use($stn_data){
                foreach ($stn_data as $stn) {
                    if ($stn->station_id === $node->station_id) {
                        /* return only nodes whose stations are enabled */
                        return $node;
                    }
                }
            });

            // dd($node_data);
            /* remove nulls */
            $node_data = $node_data->reject(function($node){
                return $node === null;
            });
            // dd($node_data);
        }
        
        
        return $node_data;
    }

    /**
     * This method returns the enabled nodes from the enabled stations
     */
    public function getNodesByNodeType($nodeType)
    {
        $node_data = '';
        /**
         * nodetype - twoMeterNode, tenMeterNode, groundNode, sinkNode 
         * $gnd_nd_tb, $twoM_nd_tb, $tenM_nd_tb, $sink_nd_tb
         * node tables - twoMeterNode, tenMeterNode, sinkNode, groundNode,
        */
        
        // dd($nodeType);
        if (stripos($nodeType, $this->towN_name) !== false) { 
            
            $node_data = DB::table($this->twoM_nd_tb)->select('node_id','station_id')->get();
        }
        elseif (stripos($nodeType, $this->tenN_name) !== false) {

            $node_data = DB::table($this->tenM_nd_tb)->select('node_id','station_id')->get();
        }
        elseif (stripos($nodeType, $this->gnd_name) !== false) {

            $node_data = DB::table($this->gnd_nd_tb)->select('node_id','station_id')->get();
        }
        elseif (stripos($nodeType, $this->sink_name) !== false) {

            $node_data = DB::table($this->sink_nd_tb)->select('node_id','station_id')->get();
        }

        // dd($node_data);        
        
        return $node_data;
    }

    /**
     * This method returns the enabled sensors from the enabled nodes
     */
    public function getEnabledSensors($status)
    {
        /* variable to hold all enabled sensors */
        $enabledSensors = collect();        
        /**
         * $sensors_tb
         * get corresponding sensors
         * nodetype - twoMeterNode, tenMeterNode, groundNode, sinkNode
         */
        /* create array to loop through node type and get all sensors */
        $nodeTypes = collect([
            $this->gnd_name,
            $this->towN_name,
            $this->tenN_name,
            $this->sink_name
        ]);
        // dd($nodeTypes);

        foreach ($nodeTypes as $nodeType) {
            // dd($nodeType); //'node_id','node_type','parameter_read'
            $sensors = DB::table($this->sensors_tb)->select('id','node_id','node_type','parameter_read')->where([
                ['node_type','=',$nodeType],
                ['sensor_status','=',$status],
            ])->get();
            // dd($sensors);
            /**
             * $gnd_nd_tb, $twoM_nd_tb, $tenM_nd_tb, $sink_nd_tb
             * node tables - twoMeterNode, tenMeterNode, sinkNode, groundNode,
            */
            $node_data = $this->getEnabledNodes($nodeType, "on");
            // dd($node_data);
            /* check if any nodes were returned */
            if (empty($node_data)) {
                /* if no nodes were returned then no sensors should be considered enabled */
                $sensors = '';
            }

            if (!empty($sensors)) {
                // dd($node_data);
                /* map enabled sensors to enabled nodes */
                $sensors->transform(function($sensor) use($node_data){
                    foreach ($node_data as $data) {
                        if ($data->node_id === $sensor->node_id) {
                            /* assign station_id to sensors whose nodes are enabled */
                            $sensor->station_id = $data->station_id;
                            return $sensor;
                        }
                    }
                });
                
                /* remove nulls */
                $sensors = $sensors->reject(function($sensor){
                    return $sensor === null;
                });
                // dd($sensors);
                /* add sensor to collection */
                $enabledSensors = $enabledSensors->concat($sensors);
            }
        }
        
        // dd($enabledSensors);
        return $enabledSensors;
    }

    /**
     * this method finds missing nodes
     */
    public function findMissingNodes($available_nodes,$criticality,$max_track_counter)
    {
        /* check two meter nodes*/
        $twoM_nds = $this->getEnabledNodes($this->get2mName(), "on");
        // dd($twoM_nds);
        if (!empty($twoM_nds)) {
            foreach ($twoM_nds as $node) {
                /* if id is not found, report the problem */
                if(array_search($node->node_id, $available_nodes[$this->get2mName()], true) === false){
                    $this->checkoutProblem($node->node_id,$this->get2mName(),$this->getProblemClassifications(),"Node","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$node->station_id,'addproblem');
                }
                else {
                    $this->checkoutProblem($node->node_id,$this->get2mName(),$this->getProblemClassifications(),"Node","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$node->station_id,'removeproblem');
                }
            }
        }

        /* check if a two meter node was disabled after being reported as off */
        $twoM_nds_2 = $this->getEnabledNodes($this->get2mName(), "off");
        if (!empty($twoM_nds_2)) {
            // dd($twoM_nds_2);
            foreach ($twoM_nds_2 as $node) {
                $this->checkoutProblem($node->node_id,$this->get2mName(),$this->getProblemClassifications(),"Node","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$node->station_id,'solveproblem');
            }
        }
        
        
        /* check ten meter nodes*/
        $tenM_nds = $this->getEnabledNodes($this->get10mName(), "on");
        if (!empty($tenM_nds)) {
            foreach ($tenM_nds as $node) {
                /* if id is not found, report the problem */
                if(array_search($node->node_id, $available_nodes[$this->get10mName()], true) === false){
                    $this->checkoutProblem($node->node_id,$this->get10mName(),$this->getProblemClassifications(),"Node","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$node->station_id,'addproblem');
                }
                else {
                    $this->checkoutProblem($node->node_id,$this->get10mName(),$this->getProblemClassifications(),"Node","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$node->station_id,'removeproblem');
                }
            }
        }

        /* check if a ten meter node was disabled after being reported as off */
        $tenM_nds_2 = $this->getEnabledNodes($this->get10mName(), "off");
        if (!empty($tenM_nds_2)) {
            foreach ($tenM_nds_2 as $node) {
                $this->checkoutProblem($node->node_id,$this->get10mName(),$this->getProblemClassifications(),"Node","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$node->station_id,'solveproblem');
            }
        }
        
        /* check ground nodes*/
        $gnd_nds = $this->getEnabledNodes($this->getGndName(), "on");
        if (!empty($gnd_nds)) {
            foreach ($gnd_nds as $node) {
                /* if id is not found, report the problem */
                if(array_search($node->node_id ,$available_nodes[$this->getGndName()], true) === false){
                    $this->checkoutProblem($node->node_id,$this->getGndName(),$this->getProblemClassifications(),"Node","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$node->station_id,'addproblem');
                }
                else {
                    $this->checkoutProblem($node->node_id,$this->getGndName(),$this->getProblemClassifications(),"Node","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$node->station_id,'removeproblem');
                }
            }
        }

        /* check if a ground node was disabled after being reported as off */
        $gnd_nds_2 = $this->getEnabledNodes($this->getGndName(), "off");
        if (!empty($gnd_nds_2)) {
            foreach ($gnd_nds_2 as $node) {
                $this->checkoutProblem($node->node_id,$this->getGndName(),$this->getProblemClassifications(),"Node","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$node->station_id,'solveproblem');
            }
        }
        
        /* check sink nodes*/
        $sink_nds = $this->getEnabledNodes($this->getSinkName(), "on");
        if (!empty($sink_nds)) {
            foreach ($sink_nds as $node) {
                /* if id is not found, report the problem */
                if(array_search($node->node_id, $available_nodes[$this->getSinkName()], true) === false){
                    $this->checkoutProblem($node->node_id,$this->getSinkName(),$this->getProblemClassifications(),"Node","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$node->station_id,"addproblem");
                }
                else {
                    $this->checkoutProblem($node->node_id,$this->getSinkName(),$this->getProblemClassifications(),"Node","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$node->station_id,"removeproblem");
                }
            }
        }

        /* check if a sink node was disabled after being reported as off */
        $sink_nds_2 = $this->getEnabledNodes($this->getSinkName(), "off");
        if (!empty($sink_nds_2)) {
            foreach ($sink_nds_2 as $node) {
                $this->checkoutProblem($node->node_id,$this->getSinkName(),$this->getProblemClassifications(),"Node","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$node->station_id,'solveproblem');
            }
        }
        
    }

    /**
     * 
     */
    public function findMissingSensors($enabled_sensors,$available_sensors,$criticality,$max_track_counter)
    {
        // dd($available_sensors);        
        // dd($enabled_sensors);
        foreach ($enabled_sensors as $enabled) {
            if (array_search($enabled->id, $available_sensors, true) === false) {
                $this->checkoutProblem($enabled->id,'sensor',$this->getProblemClassifications(),"sensor","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$enabled->station_id,"addproblem");
            }
            else {
                $this->checkoutProblem($enabled->id,'sensor',$this->getProblemClassifications(),"sensor","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$enabled->station_id,"removeproblem");
            }
        }

        /* check if a sensor was disabled after being reported as off */
        $disabled_sensors = $this->getEnabledSensors("off");
        if (!empty($disabled_sensors)) {
            foreach ($disabled_sensors as $disabled) {
                $this->checkoutProblem($disabled->id,'sensor',$this->getProblemClassifications(),"sensor","off",$this->getStationProbConfig(),$criticality,$max_track_counter,$disabled->station_id,"solveproblem");
            }
        }
    }

    /**
     * 
     */
    public function findMissingStations($available_stations)
    {
        // initialize variables with default values
        $criticality = 'Non Critical';// default criticality
        $max_track_counter = 12;// default criticality

        $enabled_stations = $this->getEnabledSations("on");

        foreach ($enabled_stations as $enabled) {
            if (array_search($enabled->station_id, $available_stations, true) === false) {
                // dd("works");
                $this->checkoutProblem($enabled->station_id,'station',$this->getProblemClassifications(),"station","inaccesible",$this->getStationProbConfig(),$criticality,$max_track_counter,$enabled->station_id,"addproblem");
                // dd("works");
            }
            else {
                $this->checkoutProblem($enabled->station_id,'station',$this->getProblemClassifications(),"station","inaccesible",$this->getStationProbConfig(),$criticality,$max_track_counter,$enabled->station_id,"removeproblem");
            }
        }

        /* check if a sensor was disabled after being reported as off */
        $disabled_stations = $this->getEnabledSations("off");
        if (!empty($disabled_stations)) {
            foreach ($disabled_stations as $disabled) {
                $this->checkoutProblem($disabled->station_id,'station',$this->getProblemClassifications(),"station","inaccesible",$this->getStationProbConfig(),$criticality,$max_track_counter,$disabled->station_id,"solveproblem");
            }
        }
    }
}

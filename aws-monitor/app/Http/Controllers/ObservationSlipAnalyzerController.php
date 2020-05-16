<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use station\Http\Controllers\Controller;
use station\Http\Controllers\AnalyzerHandler;
use DateTimeZone;
use DateTime;

class ObservationSlipAnalyzerController extends Controller
{
    private $Handler;
    private $twoM_nd_sensors;
    private $tenM_nd_sensors;
    private $gnd_nd_sensors;
    private $sink_nd_sensors;
    /* variable to store the problem configurations for the different stations from the station_problem_settings table */
    private $stn_prb_conf;
    private $problemClassfications;

    public function __construct()
    {
        $this->Handler = new AnalyzerHandler();
        /* pick configurations data */
        $this->problemClassfications = $this->Handler->getProblemClassifications();
        $this->stn_prb_conf = $this->Handler->getStationProbConfig();
        /**
         * get available sensors 
         * nodetype - twoMeterNode, tenMeterNode, groundNode, sinkNode
        */
        $this->twoM_nd_sensors = $this->Handler->getSensorConfigInfo('twoMeterNode');
        $this->tenM_nd_sensors = $this->Handler->getSensorConfigInfo('tenMeterNode');
        $this->gnd_nd_sensors = $this->Handler->getSensorConfigInfo('groundNode');
        $this->sink_nd_sensors = $this->Handler->getSensorConfigInfo('sinkNode');

        // dd($this->twoM_nd_sensors);
        // dd($this->tenM_nd_sensors);
        // dd($this->gnd_nd_sensors);
        // dd($this->sink_nd_sensors);

        // dd($sensorInfo);
    }

    /**
     * Function that is run
      */
    public function analyze($available_stations)
    {        
        // first clean DB
        // $this->Handler->cleanDBTable($this->Handler->getProbTbName());

        
        // store the first and last id checked  ->where()
        $id_first_checked = 0;
        $id_last_checked = 0;
        $counter = 0;

        /* get last id that was analyzed */
        $lastId = $this->Handler->getLastId('observationslip');

        // initialize variables with default values
        $criticality = 'Non Critical';// default criticality
        $max_track_counter = 12;// default criticality

        /* array to hold available sensors */
        $available_sensors = array();

        /* collection to store sensor data */
        $sensor_data = collect();
        
        // pick problem station configurations
        $stn_prb_conf = $this->stn_prb_conf;

        /* get the available sensors */
        $recorded_sensors = $this->Handler->getEnabledSensors("on");
        // $recorded_sensors = $this->Handler->getSensors();

        // dd($recorded_sensors);

        /* param read values */
        $relHumidity = 'relative humidity';
        $temp = 'Temperature';
        $insulation = 'insulation';
        $windSpeed = 'wind speed';
        $windDirection = 'wind direction';
        $rainfall = 'preciptation';
        $soilMoisture = 'soil moisture';
        $soilTemp = 'soil temperature';
        $pressure = 'pressure';

        // sunduration
        DB::table($this->Handler->getObservationSlipTbName())->orderBy('id')->select('id','Station','Rainfall','Dry_Bulb','Wet_Bulb','Wind_Direction','Wind_Speed','SoilMoisture','SoilTemperature','CLP')->where('id','>',$lastId)->chunk(100, function($sensors) use(&$date, &$id_first_checked, &$id_last_checked, &$counter, &$sensor_data, &$available_sensors, &$relHumidity, &$temp, &$insulation, &$windSpeed, &$windDirection, &$rainfall, &$soilMoisture, &$soilTemp, &$pressure, &$recorded_sensors,&$available_stations){

            // parameter_read - relative humidity(2mnd), Temperature(2mnd), insulation(10mnd), wind speed(10mnd), wind direction(), preciptation(gndnd), soil moisture(gnd), soil temperature(gnd), pressure(sinknd)
            
            foreach ($sensors as $sensor) {

                //store first id
                if ($id_first_checked == 0) {// ensure it's not yet set
                    $id_first_checked = $sensor->id;
                }
                //store last id checked
                $id_last_checked = $sensor->id;// keep overwritting to keep the last checked
                /* store the station id if it isn't there already. search strictly */
                if ((array_search($sensor->Station, $available_stations, true)) === false) {
                    array_push($available_stations, $sensor->Station);
                }
                
                // ------------------------------------------------------------------------------
                /* 'id','Station','Rainfall','Dry_Bulb','Wet_Bulb','Wind_Direction','Wind_Speed','SoilMoisture','SoilTemperature' */
                /* $this->twoM_nd_sensors, $this->tenM_nd_sensors, $this->gnd_nd_sensors, $this->sink_nd_sensors */
                // check for nulls
                if (!empty($sensor->Rainfall) && stripos($sensor->Rainfall, "(null)") === false) {
                    // $this->gnd_nd_sensors;
                    $sensor_id = $this->Handler->getSensorId($recorded_sensors, $rainfall, $sensor->Station);
                    if ($sensor_id !== -1) {
                        /* store the node id if it isn't there already. search strictly */
                        if ((array_search($sensor_id, $available_sensors, true)) === false) {
                            array_push($available_sensors, $sensor_id);
                        }           
                        /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure */
                        $sensor_data->put($rainfall.$sensor->Station,['param' => $rainfall, 'Station' => $sensor->Station, 'param_value' => $sensor->Rainfall, 'sensor_id' => $sensor_id]);
                    }
                }

                if (!empty($sensor->Dry_Bulb) && !empty($sensor->Wet_Bulb)) {// then both sensors are on
                    // $this->twoM_nd_sensors;
                    $sensor_id = $this->Handler->getSensorId($recorded_sensors, $temp, $sensor->Station);
                    $sensor_id_2 = $this->Handler->getSensorId($recorded_sensors, $relHumidity, $sensor->Station);
                    if ($sensor_id !== -1) {
                        /* store the node id if it isn't there already. search strictly */
                        if ((array_search($sensor_id, $available_sensors, true)) === false) {
                            array_push($available_sensors, $sensor_id);
                        }
                        /* store the node id if it isn't there already. search strictly */
                        if ((array_search($sensor_id_2, $available_sensors, true)) === false) {
                            array_push($available_sensors, $sensor_id_2);
                        }          
                        /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure */
                        /* this is not yet handled */
                        // $sensor_data->put($temp.$sensor->Station,['param' => $temp, 'Station' => $sensor->Station, 'param_value' => $sensor->Dry_Bulb, 'sensor_id' => $sensor_id]);
                        // $sensor_data->put($relHumidity.$sensor->Station,['param' => $relHumidity, 'Station' => $sensor->Station, 'param_value' => $sensor->Wet_Bulb, 'sensor_id' => $sensor_id_2]);
                    }
                }

                if (!empty($sensor->Wind_Direction) && stripos($sensor->Wind_Direction, "(null)") === false) {
                    // $this->tenM_nd_sensors;
                    $sensor_id = $this->Handler->getSensorId($recorded_sensors, $windDirection, $sensor->Station);
                    if ($sensor_id !== -1) {
                        /* store the node id if it isn't there already. search strictly */
                        if ((array_search($sensor_id, $available_sensors, true)) === false) {
                            array_push($available_sensors, $sensor_id);
                        }
                        /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure */
                        $sensor_data->put($windDirection.$sensor->Station,['param' => $windDirection, 'Station' => $sensor->Station, 'param_value' => $sensor->Wind_Direction, 'sensor_id' => $sensor_id]);
                    }
                }

                if (!empty($sensor->Wind_Speed) && stripos($sensor->Wind_Speed, "(null)") === false) {
                    // $this->tenM_nd_sensors;
                    $sensor_id = $this->Handler->getSensorId($recorded_sensors, $windSpeed, $sensor->Station);
                    if ($sensor_id !== -1) {
                        /* store the node id if it isn't there already. search strictly */
                        if ((array_search($sensor_id, $available_sensors, true)) === false) {
                            array_push($available_sensors, $sensor_id);
                        }
                        /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure */
                        $sensor_data->put($windSpeed.$sensor->Station,['param' => $windSpeed, 'Station' => $sensor->Station, 'param_value' => $sensor->Wind_Speed, 'sensor_id' => $sensor_id]);
                    }
                }

                if (!empty($sensor->SoilMoisture) && stripos($sensor->SoilMoisture, "(null)") === false) {
                    // $this->gnd_nd_sensors;
                    $sensor_id = $this->Handler->getSensorId($recorded_sensors, $soilMoisture, $sensor->Station);
                    if ($sensor_id !== -1) {
                        /* store the node id if it isn't there already. search strictly */
                        if ((array_search($sensor_id, $available_sensors, true)) === false) {
                            array_push($available_sensors, $sensor_id);
                        }
                        /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure */
                        $sensor_data->put($soilMoisture.$sensor->Station,['param' => $soilMoisture, 'Station' => $sensor->Station, 'param_value' => $sensor->SoilMoisture, 'sensor_id' => $sensor_id]);
                    }
                }

                if (!empty($sensor->SoilTemperature) && stripos($sensor->SoilTemperature, "(null)") === false) {
                    // $this->gnd_nd_sensors;
                    $sensor_id = $this->Handler->getSensorId($recorded_sensors, $soilTemp, $sensor->Station);
                    if ($sensor_id !== -1) {
                        /* store the node id if it isn't there already. search strictly */
                        if ((array_search($sensor_id, $available_sensors, true)) === false) {
                            array_push($available_sensors, $sensor_id);
                        }
                        /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure */
                        $sensor_data->put($soilTemp.$sensor->Station,['param' => $soilTemp, 'Station' => $sensor->Station, 'param_value' => $sensor->SoilTemperature, 'sensor_id' => $sensor_id]);
                    }                    
                }

                if (!empty($sensor->CLP) && stripos($sensor->CLP, "(null)") === false) {
                    // $this->sink_nd_sensors;
                    $sensor_id = $this->Handler->getSensorId($recorded_sensors, $pressure, $sensor->Station);
                    if ($sensor_id !== -1) {
                        /* store the node id if it isn't there already. search strictly */
                        if ((array_search($sensor_id, $available_sensors, true)) === false) {
                            array_push($available_sensors, $sensor_id);
                        }
                        /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure */
                        $sensor_data->put($pressure.$sensor->Station,['param' => $pressure, 'Station' => $sensor->Station, 'param_value' => $sensor->CLP, 'sensor_id' => $sensor_id]);
                    }
                }
                
                $counter++;
            }         

            // dd($counter);
            if ($counter === 500) { // check if max has been reached.
                // dd($counter);   
                return false; // stop chucking...
            }
        });

        // dd($available_sensors);
        // dd($sensor_data);

        /* check for missing sensors */
        $this->Handler->findMissingSensors($recorded_sensors,$available_sensors,$criticality,$max_track_counter); 
        
        // check for missing stations
        $this->Handler->findMissingStations($available_stations);
        
        $sensor_data->map(function($value, $key) use($stn_prb_conf,$criticality,$max_track_counter,$relHumidity, $temp, $insulation, $windSpeed, $windDirection, $rainfall, $soilMoisture, $soilTemp, $pressure){

            /* 
            "param" => "preciptation"
            "Station" => 1
            "param_value" => "Th"
            "sensor_id" => -1 */
            $param = $value['param'];
            $station_id = $value['Station'];
            $param_value = $value['param_value'];
            $sensor_id = $value['sensor_id'];
            // check for nulls
            // dd($param . " - " . $station_id . " - " . $sensor_id);
            if (stripos($param, $rainfall) !== false) {
                /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure */
                $this->Handler->analyzeSensorData($this->gnd_nd_sensors, $station_id, 'preciptation', $param_value, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter, $sensor_id);
            }
            if (stripos($param, $temp) !== false) {// check for strings
                // /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure 
                /* this doesn't yet have values to use for comparison */
                // $this->Handler->analyzeSensorData($this->twoM_nd_sensors, $station_id, 'Temperature', $param_value, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter, $sensor_id);

            }
            if (stripos($param, $relHumidity) !== false) {// check for strings
                // /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure 
                /* this doesn't yet have values to use for comparison */
                // $this->Handler->analyzeSensorData($this->twoM_nd_sensors, $station_id, 'relative humidity', $param_value, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter, $sensor_id);

            }
            if (stripos($param, $windDirection) !== false) {
                /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure */
                $this->Handler->analyzeSensorData($this->tenM_nd_sensors, $station_id, 'wind direction', $param_value, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter, $sensor_id);
            }
            if (stripos($param, $windSpeed) !== false) {
                /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure */
                $this->Handler->analyzeSensorData($this->tenM_nd_sensors, $station_id, 'wind speed', $param_value, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter, $sensor_id);
            }
            if (stripos($param, $soilMoisture) !== false) {
                // $this->gnd_nd_sensors;
                $this->Handler->analyzeSensorData($this->gnd_nd_sensors, $station_id, 'soil moisture', $param_value, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter, $sensor_id);
            }
            if (stripos($param, $soilTemp) !== false) {
                /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure */
                $this->Handler->analyzeSensorData($this->gnd_nd_sensors, $station_id, 'soil temperature', $param_value, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter, $sensor_id);
            }
            if (stripos($param, $pressure) !== false) {
                /* relHumidity - temp - insulation - windSpeed - windDirection - rainfall - soilMoisture - soilTemp - pressure */
                $this->Handler->analyzeSensorData($this->sink_nd_sensors, $station_id, 'pressure', $param_value, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter, $sensor_id);
            }
        });

        $no_of_recs = $id_last_checked - $id_first_checked + 1;
        if ($no_of_recs === 1) {
            $no_of_recs = 0;
        }

        if ($id_last_checked === 0) {
            $id_last_checked = $lastId;
        }
        
        // update last check table
        $this->Handler->updateChecksTable('observationslip',$id_first_checked,$id_last_checked);

        //show data in the problems table
        return;
        /* return redirect('/probTbData')->with([
            'flash_message' => 'Analyzed '. $no_of_recs .' records'
        ]); */
    }
}

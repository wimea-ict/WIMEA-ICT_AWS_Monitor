<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class AnalyzerConstants extends Controller
{
    /* use constants instead */
    const PROBLEM_CLASSIFN_TB =  "problem_classification";
    const STNS_TB = "stations";
    const STATN_PROB_STTNGS_TB = "station_problem_settings";
    const PROB_TB = "problems";
    const SENSORS_TB = "sensors";
    const GND_ND_TB = "groundNode";
    const TWOM_ND_TB = "twoMeterNode";
    const TENM_ND_TB = "tenMeterNode";
    const SINK_ND_TB = "sinkNode";
    const TIMEZONE = "Africa/Kampala";
    const GND_NAME = "ground_node";
    const TWOMN_NAME = "2m_node";
    const TENN_NAME = "10m_node";
    const SINK_NAME = "sink_node";

    public function getProbClassifnTbName()
    {
        return self::PROBLEM_CLASSIFN_TB;
    }
    
    public function getStatnTbName()
    {
        return self::STNS_TB;
    }
    public function getSensorTbName()
    {
        return self::SENSORS_TB;
    }
    public function getGndTbName()
    {
        return self::GND_ND_TB;
    }
    public function getProbTbName()
    {
        return self::PROB_TB;
    }

}

<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class problemConfigurations extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'station_problem_settings';

    protected $fillable = ['station_id','problem_id','max_track_counter','report_method','criticality','reporting_time_interval'];
    
}

<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    // protected $table = 'observationslip';

    /**
     * Indicates if the model should be timestamped
     * 
     * @var bool
     */
    // public $timestamps = false;

    // const CREATED_AT = 'CreationDate';
    
    //
    protected $fillable = ['node_id','parameter_read','identifier_used','min_value','max_value','node_type','report_time_interval'];
}

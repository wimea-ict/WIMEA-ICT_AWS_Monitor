<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Sinknode extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'SinkNode';

    protected $primaryKey = 'id';
    //protected $timestamps = false;
    //const CREATED_AT = 'CreationDate';
    //const UPDATED_AT = 'UpdateDate';


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
protected $fillable = ['id','stationID','RTC_T','NAME','E64','P_MS5611','V_IN','V_MCU','UP_TIME','T','SEQ','DATE','TIME','parameterChecked','Ignore on calc trend','Trend checked','hoursSinceEpoch' /*'station_id','date_sink','time_sink', 'ut_sink','gw_lat_sink','gw_long_sink','v_mcu_sink','v_in_sink', 'ttl_sink','rssi_sink','lqi_sink','drp_sink','e64_sink','txt_sink', 'p_ms5611_sink','v_in_min_value','v_in_max_value','v_mcu_min_value', 'v_mcu_max_value','ps_sink','up_sink','t_sink','node_status', 'txt_sink_value', 'CreationDate','UpdateDate'*/];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    //protected $dates = ['date', 'date_time_recorded', 'Date', 'CreationDate'];
      protected $dates = [];
}

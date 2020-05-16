<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class TwoMeterNode extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'TwoMeterNode';

    protected $primaryKey = 'id';
    //protected $timestamps = false;
    //const CREATED_AT = 'CreationDate';
    //const UPDATED_AT = 'UpdateDate';

protected $fillable = ['id','stationID','RTC_T','NAME','E64','T_SHT2X','checked','RH_SHT2X','checkr','RSSI','TTL','LQI','V_IN','V_MCU','SEQ','UP_TIME','T','DATE','TIME','Parameter checked','Trend checked','Ignore on calc trend','hoursSinceEpoch' /*,'v_in_max_value','v_in_min_value','v_mcu_max_value','v_mcu_min_value', 'CreationDate','UpdateDate'*/];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
   // protected $dates = ['date', 'date_time_recorded', 'Date', 'CreationDate', 'Opened', 'Closed', 'CreationDate'];
      protected $dates = [];
}

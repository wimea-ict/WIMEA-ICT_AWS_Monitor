<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Groundnode extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'GroundNode';

    protected $primaryKey = 'id';
    // protected $timestamps = false;
    //const CREATED_AT = 'CreationDate';
    //const UPDATED_AT = 'UpdateDate';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
  protected $fillable = ['id', 'stationID', 'RTC_T', 'NAME', 'E64', 'V_A1', 'V_A2', 'PO_LST60','T1', 'RSSI', 'TTL', 'LQI', 'SEQ', 'UP_TIME', 'T','V_IN','V_MCU', 'DATE', 'TIME', 'Parameter checked','Trend checked', 'Ignore on calc trend','hoursSinceEpoch'  /*,'v_in_min_value','v_mcu_max_value','v_mcu_min_value', 'CreationDate','UpdateDate'*/];

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
    protected $dates = [];

}

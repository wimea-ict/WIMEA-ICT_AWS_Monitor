<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Nodestatus extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nodestatus';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['V_MCU', 'V_IN', 'RSSI', 'LQI', 'DRP', 'date', 'time', 'TXT', 'E64', 'StationNumber', 'date_time_recorded'];

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
    protected $dates = ['date', 'date_time_recorded'];

}
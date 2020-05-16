<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Station extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stations';
    protected $primaryKey = 'station_id';
    // protected $timestamps = false;
    const CREATED_AT = 'Creation_Date';
    const UPDATED_AT = 'UpdateDate';


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['station_id', 'StationName', 'StationNumber', 'StationRegNumber', 'Location', 'Indicator', 'StationRegion', 'Country', 'Latitude', 'Longitude', 'Altitude', 'StationStatus', 'StationType', 'Opened', 'Closed', 'SubmittedBy', 'Creation_Date','UpdateDate','StationCategory'];

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
    protected $dates = ['date', 'date_time_recorded', 'Date', 'CreationDate', 'Opened', 'Closed', 'CreationDate'];

}

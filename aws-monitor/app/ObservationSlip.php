<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Observationslip extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'observationslip';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Date', 'Station', 'TIME', 'TotalAmountOfAllClouds', 'TotalAmountOfLowClouds', 'TypeOfLowClouds1', 'OktasOfLowClouds1', 'HeightOfLowClouds1', 'CLCODEOfLowClouds1', 'TypeOfLowClouds2', 'OktasOfLowClouds2', 'HeightOfLowClouds2', 'CLCODEOfLowClouds2', 'TypeOfLowClouds3', 'OktasOfLowClouds3', 'HeightOfLowClouds3', 'CLCODEOfLowClouds3', 'TypeOfMediumClouds1', 'OktasOfMediumClouds1', 'HeightOfMediumClouds1', 'CLCODEOfMediumClouds1', 'TypeOfMediumClouds2', 'OktasOfMediumClouds2', 'HeightOfMediumClouds2', 'CLCODEOfMediumClouds2', 'TypeOfMediumClouds3', 'OktasOfMediumClouds3', 'HeightOfMediumClouds3', 'CLCODEOfMediumClouds3', 'TypeOfHighClouds1', 'OktasOfHighClouds1', 'HeightOfHighClouds1', 'CLCODEOfHighClouds1', 'TypeOfHighClouds2', 'OktasOfHighClouds2', 'HeightOfHighClouds2', 'CLCODEOfHighClouds2', 'TypeOfHighClouds3', 'OktasOfHighClouds3', 'HeightOfHighClouds3', 'CLCODEOfHighClouds3', 'CloudSearchLightReading', 'Rainfall', 'Dry_Bulb', 'Wet_Bulb', 'Max_Read', 'Max_Reset', 'Min_Read', 'Min_Reset', 'Piche_Read', 'Piche_Reset', 'TimeMarksThermo', 'TimeMarksHygro', 'TimeMarksRainRec', 'Present_Weather', 'Present_WeatherCode', 'Past_Weather', 'Visibility', 'Wind_Direction', 'Wind_Speed', 'Gusting', 'AttdThermo', 'PrAsRead', 'Correction', 'CLP', 'MSLPr', 'TimeMarksBarograph', 'TimeMarksAnemograph', 'OtherTMarks', 'Remarks', 'SubmittedBy', 'Approved', 'CreationDate', 'SoilMoisture', 'SoilTemperature', 'sunduration', 'trend', 'windrun', 'speciormetar', 'UnitOfWindSpeed', 'IndOrOmissionOfPrecipitation', 'TypeOfStation_Present_Past_Weather', 'HeightOfLowestCloud', 'StandardIsobaricSurface', 'GPM', 'DurationOfPeriodOfPrecipitation', 'GrassMinTemp', 'CI_OfPrecipitation', 'BE_OfPrecipitation', 'IndicatorOfTypeOfIntrumentation', 'SignOfPressureChange', 'Supp_Info', 'VapourPressure', 'T_H_Graph', 'DeviceType'];

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
    protected $casts = ['Approved' => 'boolean'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date', 'date_time_recorded', 'Date', 'CreationDate'];

}

<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable=["problem_id","datetime","message","report_counter","station_id","node","sensor"];
    public $timestamps = false;
}

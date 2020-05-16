<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        'node','rainfall','temperature','relative humidity'
    ];
}

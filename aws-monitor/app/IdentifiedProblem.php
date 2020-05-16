<?php

namespace station;

use Illuminate\Database\Eloquent\Model;

class IdentifiedProblem extends Model
{
    //
 
    protected $fillable=["node_id","v_in_label","v_in_key_title","v_in_key_value",
                        "v_in_min_value","v_in_max_value","v_mcu_label","v_mcu_key_title",
                        "v_mcu_key_value","v_mcu_min_value","v_mcu_max_value"];

                    
}

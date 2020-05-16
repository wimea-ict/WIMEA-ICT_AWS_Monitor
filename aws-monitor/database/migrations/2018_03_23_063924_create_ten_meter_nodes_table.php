<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenMeterNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('ten_meter_nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id');
            $table->string('date_10m');
            $table->string('time_10m');
            $table->string('ut_10m');
            $table->string('gw_lat_10m');
            $table->string('gw_long_10m');
            $table->string('e64_10m');
            $table->string('v_a1_10m');
            $table->string('v_a2_10m');
            $table->string('v_a3_10m');
            $table->string('ttl_10m');
            $table->string('rssi_10m');
            $table->string('lqi_10m');
            $table->string('drp_10m');
            $table->string('txt_10m');
            $table->string('ps_10m');
            $table->string('txt_value_10m');
            $table->string('v_in_10m');
            $table->string('v_mcu_10m');
            $table->double('v_in_min_value');
            $table->double('v_in_max_value');
            $table->double('v_mcu_min_value');
            $table->double('v_mcu_max_value');
            $table->enum('node_status',["off","on"]);
            
            $table->timestamps();
        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ten_meter_nodes');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwoMeterNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('two_meter_nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id');
            $table->string('date_2m');
            $table->string('time_2m');
            $table->string('ut_2m');
            $table->string('gw_lat_2m');
            $table->string('gw_long_2m');
            $table->string('v_mcu_2m');
            $table->string('v_in_2m');
            $table->string('ttl_2m');
            $table->string('rssi_2m');
            $table->string('lqi_2m');
            $table->string('drp_2m');
            $table->string('e64_2m');
            $table->string('txt_2m');
            $table->string('txt_value2m');
            $table->string('t_sht2x_2m');
            $table->string('rh_sh2x_2m');
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
        Schema::dropIfExists('two_meter_nodes');
    }
}

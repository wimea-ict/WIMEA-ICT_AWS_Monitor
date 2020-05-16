<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinkNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('sink_nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id');
            $table->string('date_sink');
            $table->string('time_sink');
            $table->string('ut_sink');
            $table->string('gw_lat_sink');
            $table->string('gw_long_sink');
            $table->string('e64_sink');
            $table->string('t_sink');
            $table->string('ps_sink');
            $table->string('up_sink');
            $table->string('v_mcu_sink');
            $table->string('v_in_sink');
            $table->string('p_ms5611_sink');
            $table->string('ttl_sink');
            $table->string('lqi_sink');
            $table->string('drp_sink');
            $table->string('rssi_sink');
            $table->string('txt_sink');
            $table->string('txt_value_sink');
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
        Schema::dropIfExists('sink_nodes');
    }
}

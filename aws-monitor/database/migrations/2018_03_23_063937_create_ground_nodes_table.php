<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroundNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('ground_nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id');
            $table->string('date_gnd');
            $table->string('time_gnd');
            $table->string('ut_gnd');
            $table->string('gw_lat_gnd');
            $table->string('gw_long_gnd');
            $table->string('ps_gnd');
            $table->string('v_mcu_gnd');
            $table->string('v_in_gnd');
            $table->string('po_lst60_gnd');
            $table->string('up_gnd');
            $table->string('v_a1_gnd');
            $table->string('v_a2_gnd');
            $table->string('ttl_gnd');
            $table->string('rssi_gnd');
            $table->string('lqi_gnd');
            $table->string('drp_gnd');
            $table->string('e64_gnd');
            $table->string('txt_gnd');
            $table->string('txt_value_gnd');
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
        Schema::dropIfExists('ground_nodes');
    }
}

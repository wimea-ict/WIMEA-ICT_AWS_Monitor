<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodeStatusConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('node_status_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('node_id')->unsigned();
            $table->string('v_in_label');
            $table->string('v_in_key_title');
            $table->string('v_in_key_value');
            $table->double('v_in_min_value');
            $table->double('v_in_max_value');
            $table->string('v_mcu_label');
            $table->string('v_mcu_key_title');
            $table->string('v_mcu_key_value');
            $table->double('v_mcu_min_value');
            $table->double('v_mcu_max_value');
            $table->foreign('node_id')->references('node_id')->on('nodes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('node_status_configurations');
    }
}

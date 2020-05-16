<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentifiedProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identified_problems', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date_time_recorded');
            $table->integer('hourly_track_counter');
            $table->enum('problem_state',["investigation","reported","resolved"]);
            $table->integer('node_id');
            $table->integer('station_id');
            $table->integer('sensor_id');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identified_problems');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('node_id')->unsigned();
<<<<<<< HEAD
=======
            $table->enum('node_type',["twoMeterNode","tenMeterNode","groundNode","sinkNode"])->comment('this should be the table of the node e.g twoMeterNode');
>>>>>>> b838b37bc10a9bd92782f5e0213406537638fa83
            $table->string('parameter_read');
            $table->string('identifier_used');
            $table->string('min_value');
            $table->string('max_value');
            $table->string('report_time_interval');
<<<<<<< HEAD
            $table->foreign('node_id')->references('node_id')->on('nodes'); 
=======
            $table->enum('sensor_status',["off","on"]);
>>>>>>> b838b37bc10a9bd92782f5e0213406537638fa83
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
        Schema::dropIfExists('sensors');
    }
}

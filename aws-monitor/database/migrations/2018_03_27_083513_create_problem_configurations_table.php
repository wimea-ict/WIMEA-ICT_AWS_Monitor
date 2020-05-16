<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_configurations', function (Blueprint $table) {
            $table->increments('id');
<<<<<<< HEAD:database/migrations/2018_02_12_061620_create_node_statuses_table.php
            $table->integer('node_id')->unsigned();
            $table->double('v_in');
            $table->double('rssi');
            $table->double('drop');
            $table->double('vmcu');
            $table->double('lqi');
            $table->dateTime('date_time');
            $table->foreign('node_id')->references('node_id')->on('nodes');
=======
            $table->time('investigation_hours');
            $table->enum('report_method',["sms","email","both"]);
            $table->integer('reporting_time_diff');
>>>>>>> b838b37bc10a9bd92782f5e0213406537638fa83:database/migrations/2018_03_27_083513_create_problem_configurations_table.php
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
        Schema::dropIfExists('problem_configurations');
    }
}

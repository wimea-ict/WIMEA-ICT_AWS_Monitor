<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemClassificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD:database/migrations/2018_02_12_061442_create_nodes_table.php
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('node_id');
            $table->integer('station_id')->unsigned();
            $table->string('txt_key');
            $table->string('mac_address');
            $table->foreign('station_id')->references('station_id')->on('stations'); 
=======
        Schema::create('problem_classification', function (Blueprint $table) {
            $table->increments('id');
            $table->string('problem_description');
            $table->enum('source',["node","station","sensor"]);
>>>>>>> b838b37bc10a9bd92782f5e0213406537638fa83:database/migrations/2018_04_02_101811_create_problem_classification_table.php
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
        Schema::dropIfExists('problem_classification');
    }
}

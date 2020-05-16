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
            $table->integer('station_id');
            $table->integer('problem_id');
            $table->double('investigation_hours');
            $table->enum('report_method',["sms","email"]);
            $table->enum('criticality',["Critical","Non Critical"]);
            $table->integer('reporting_time_interval');
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

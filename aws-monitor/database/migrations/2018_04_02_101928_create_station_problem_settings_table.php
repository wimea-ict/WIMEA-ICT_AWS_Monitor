<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationProblemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_problem_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id')->unsigned();
            $table->integer('classification_id')->unsigned();
            $table->integer('max_track_counter')->unsigned();
            $table->integer('reporting_time_interval')->unsigned();
            $table->enum('report_method',["sms","email","both"]);
            $table->enum('criticality',["critical","non_critical"]);
            $table->timestamps();
        });

        // Schema::table('station_problem_settings', function (Blueprint $table) {
        //     $table->foreign('station_id')->references('station_id')->on('stations');
        //     $table->foreign('problem_id')->references('id')->on('problem_classification');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('station_problem_settings');
    }
}

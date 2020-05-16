<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePotentialProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potential_problems', function (Blueprint $table) {
            $table->increments('problem_id');
            $table->string("problem_description");
            //references node or station
            $table->enum('problem_source', ['node','station','sensor'])->default('sensor');
            $table->integer("problem_source_id");//references node or station or sensor
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
        Schema::dropIfExists('potential_problems');
    }
}

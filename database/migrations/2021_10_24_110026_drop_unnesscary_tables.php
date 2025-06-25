<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUnnesscaryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('user_course_impact_measurement_answers');
        Schema::dropIfExists('impact_measurement_questions');
        Schema::dropIfExists('user_course_impact_measurements');
        Schema::dropIfExists('impact_measurement_questions');
        Schema::dropIfExists('impact_measurements');

       



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

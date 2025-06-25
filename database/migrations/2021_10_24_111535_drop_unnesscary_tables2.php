<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUnnesscaryTables2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user_training_data');
        Schema::dropIfExists('user_training_data_answers');
        Schema::dropIfExists('training_data_questions_options');
        Schema::dropIfExists('training_data_questions');
        Schema::dropIfExists('training_data');
        // /////////////////
        Schema::dropIfExists('user_course_program_recommendations');
        Schema::dropIfExists('user_course_program_recommendations_answers');
        Schema::dropIfExists('program_recommendation_questions_options');
        Schema::dropIfExists('program_recommendation_questions');
        Schema::dropIfExists('program_recommendations');

        // //////////
        // Schema::dropIfExists('user_rate_answers');
        // Schema::dropIfExists('user_course_rates');
        // Schema::dropIfExists('course_rates');
        // Schema::dropIfExists('rate_questions');
        // Schema::dropIfExists('rates');

        //
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

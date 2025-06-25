<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rate_answers', function (Blueprint $table) {
            $table->increments('id');

          
            $table->unsignedInteger('user_course_rate_id')->nullable();
            $table->unsignedInteger('rate_question_id')->nullable();
            $table->text('answer')->nullable();
            $table->text('notes')->nullable();

            $table->foreign('user_course_rate_id')->references('id')->on('user_course_rates')->onDelete('cascade');
            $table->foreign('rate_question_id')->references('id')->on('rate_questions')->onDelete('cascade');
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
        Schema::dropIfExists('user_rate_answers');
    }
}

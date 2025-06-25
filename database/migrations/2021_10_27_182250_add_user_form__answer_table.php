<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserFormAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_form_answers', function (Blueprint $table) {
            //
            $table->increments('id');
           
          
            $table->unsignedInteger('user_course_form_id')->nullable();
            $table->unsignedInteger('question_id')->nullable();
            $table->text('answer')->nullable();
            $table->text('notes')->nullable();

            $table->foreign('user_course_form_id')->references('id')->on('user_course_forms')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
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
        Schema::table('user_form_answers', function (Blueprint $table) {
            //
        });
    }
}

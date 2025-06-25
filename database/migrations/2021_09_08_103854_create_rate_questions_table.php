<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question');
            $table->text('question_ar');
            $table->text('question_option')->nullable()->comment('option delimited by comma');
            $table->text('question_option_ar')->nullable()->comment('option delimited by comma');
            $table->string('question_type')->nullable()->comment('radio,text');
           
            $table->unsignedInteger('rate_id')->nullable();
            $table->foreign('rate_id')->references('id')->on('rates')->onDelete('cascade');

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
        Schema::dropIfExists('rate_questions');
    }
}

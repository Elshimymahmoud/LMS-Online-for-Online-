<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
        Schema::create('course_rates', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('course_id')->nullable();
            $table->unsignedInteger('rate_id')->nullable();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
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
        Schema::dropIfExists('course_rates');
    }
}

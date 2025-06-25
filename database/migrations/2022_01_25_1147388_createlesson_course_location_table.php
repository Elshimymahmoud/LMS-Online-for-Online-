<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatelessonCourseLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_course_location', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model_type');

            $table->unsignedInteger('model_id')->nullable();
           
            $table->unsignedInteger('course_location_id')->nullable();
           
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_course_location');
    }
}

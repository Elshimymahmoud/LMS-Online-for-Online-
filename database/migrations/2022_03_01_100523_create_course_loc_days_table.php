<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseLocDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_loc_days', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_ar');
            $table->unsignedInteger('course_location_id')->nullable();
           
            $table->foreign('course_location_id','fk_course_loc_days')->references('id')->on('course_locations')->onDelete('cascade');
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
        Schema::dropIfExists('course_loc_days');
    }
}

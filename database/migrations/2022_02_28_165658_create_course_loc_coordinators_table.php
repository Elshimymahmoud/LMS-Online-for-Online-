<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseLocCoordinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_loc_coordinators', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_location_id')->nullable();
           
            $table->foreign('course_location_id','fk_course_loc_coord')->references('id')->on('course_locations')->onDelete('cascade');
            $table->unsignedInteger('coordinators_id')->nullable();
           
            $table->foreign('coordinators_id')->references('id')->on('coordinators')->onDelete('cascade');
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
        Schema::dropIfExists('course_loc_coordinators');
    }
}

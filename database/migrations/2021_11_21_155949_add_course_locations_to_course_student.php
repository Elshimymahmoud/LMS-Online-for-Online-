<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCourseLocationsToCourseStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_student', function (Blueprint $table) {
            //
            $table->unsignedInteger('course_location_id')->nullable();
           
            $table->foreign('course_location_id')->references('id')->on('course_locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_student', function (Blueprint $table) {
            //
            $table->dropColumn('course_location_id');

           
        });
    }
}

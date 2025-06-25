<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCourseLocationsForigen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_locations', function (Blueprint $table) {
            //
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            
            // comment this becuase dont find location tabel
            // $table->integer('location_id')->unsigned()->nullable();
            // $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_locations', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCourseclintToCourseLocation extends Migration
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
            $table->string('place')->nullable();
            $table->integer('CoursClint_id')->unsigned()->nullable();
            $table->foreign('CoursClint_id')->references('id')->on('course_clints')->onDelete('cascade');

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

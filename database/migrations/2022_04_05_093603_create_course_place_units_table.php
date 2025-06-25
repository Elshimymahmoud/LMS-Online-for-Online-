<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursePlaceUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_place_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_ar');

            $table->integer('place_id')->unsigned()->nullable();
            $table->foreign('place_id')->references('id')->on('course_places')->onDelete('cascade');


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
        Schema::dropIfExists('course_place_units');
    }
}

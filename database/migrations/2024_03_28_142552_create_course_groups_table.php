<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_groups', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title_en');
            $table->string('title_ar');

            $table->text('description_en');
            $table->text('description_ar');

            $table->integer('number_hours')->nullable();
            $table->string('image')->nullable();
            $table->string('location');
            $table->integer('price')->nullable();

            $table->dateTime('start');
            $table->dateTime('end');

            $table->unsignedInteger('location_id');
            $table->unsignedInteger('place_id');
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->cascadeOnDelete();
            $table->foreign('location_id')->references('id')->on('locations')->cascadeOnDelete();
            $table->foreign('place_id')->references('id')->on('places')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_groups');
    }
}

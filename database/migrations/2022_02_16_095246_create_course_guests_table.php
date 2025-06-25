<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_guests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->integer('guest_id')->unsigned()->nullable();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
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
        Schema::dropIfExists('course_guests');
    }
}

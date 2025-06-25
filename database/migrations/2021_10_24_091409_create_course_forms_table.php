<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id')->nullable();
            $table->unsignedInteger('forms_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('forms_id')->references('id')->on('forms')->onDelete('cascade');

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
        Schema::dropIfExists('course_forms');
    }
}

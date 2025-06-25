<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('organization');
            $table->string('phone');
            $table->string('course_name');
            $table->text('message');

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
        Schema::dropIfExists('request_courses');
    }
}

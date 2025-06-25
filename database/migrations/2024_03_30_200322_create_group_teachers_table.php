<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_teachers', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('group_id')->unsigned();
            $table->integer('teacher_id')->unsigned();

            $table->foreign('group_id')->references('id')->on('course_groups');
            $table->foreign('teacher_id')->references('id')->on('users');

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
        Schema::dropIfExists('group_teachers');
    }
}

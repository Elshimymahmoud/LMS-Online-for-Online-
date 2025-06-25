<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupCoordinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_coordinators', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('group_id')->unsigned();
            $table->integer('coordinator_id')->unsigned();

            $table->foreign('group_id')->references('id')->on('course_groups');
            $table->foreign('coordinator_id')->references('id')->on('coordinators');

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
        Schema::dropIfExists('group_coordinators');
    }
}

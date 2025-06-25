<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseGroupRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('course_group_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('course_group_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('rate');
            $table->text('description');
            $table->text('description_ar');
            $table->timestamps();

            $table->foreign('course_group_id')->references('id')->on('course_groups')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // foreign key constraint for user_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_group_rates');
    }
}

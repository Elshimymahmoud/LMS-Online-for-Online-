<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStudentIdToUserCourseForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_course_forms', function (Blueprint $table) {
            //
            $table->unsignedInteger('student_id')->nullable();
           
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_course_forms', function (Blueprint $table) {
            //
            $table->dropColumn('student_id');

        });
    }
}

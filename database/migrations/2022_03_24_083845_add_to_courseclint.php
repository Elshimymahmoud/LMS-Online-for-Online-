<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToCourseclint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_clints', function (Blueprint $table) {
            //
            $table->integer('status')->default(1)->comment('1 - enabled, 0 - disabled');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_clints', function (Blueprint $table) {
            //
        });
    }
}

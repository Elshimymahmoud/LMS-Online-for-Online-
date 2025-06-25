<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToAchivments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acheivments', function (Blueprint $table) {
            //
            $table->integer('status')->default(1)->comment('0 - disabled, 1 - enabled');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acheivments', function (Blueprint $table) {
            //
        });
    }
}

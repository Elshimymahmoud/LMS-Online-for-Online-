<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply_complaints', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('result_id')->nullable();
            $table->foreign('result_id')->references('id')->on('results')->onDelete('cascade');
            $table->text('reply')->nullable();

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
        Schema::dropIfExists('reply_complaints');
    }
}

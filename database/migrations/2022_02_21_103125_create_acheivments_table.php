<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcheivmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acheivments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('introduction')->nullable();
            $table->longText('content')->nullable();
            $table->string('title_ar')->nullable();
            $table->text('introduction_ar')->nullable();
            $table->longText('content_ar')->nullable();
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
        Schema::dropIfExists('acheivments');
    }
}

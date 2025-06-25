<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_colors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('body_color');
            $table->string('heading_color');
            $table->string('paragraph_color');
            $table->string('icon_color');
            $table->string('about_color');
            $table->string('courses_color');
            $table->string('speaker_color');
            $table->string('blog_color');
            $table->string('sponser_color');

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
        Schema::dropIfExists('landing_colors');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->text('zoom_url')->nullable();
                
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
        Schema::dropIfExists('course_locations');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('lesson_id')->nullable();
            $table->string('title', 191)->nullable();
            $table->string('title_ar', 255)->nullable();
            $table->text('description')->nullable();
            $table->text('description_ar')->nullable();
            $table->tinyInteger('published')->default(0)->nullable();
            $table->string('slug', 191)->nullable();
            $table->string('test_type', 200)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('chapter_id')->nullable();
            $table->unsignedTinyInteger('is_active')->default('0')->notNull();
            $table->string('form_type', 191)->nullable();
            $table->text('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}

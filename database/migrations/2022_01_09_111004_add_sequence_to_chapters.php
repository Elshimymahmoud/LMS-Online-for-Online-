<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSequenceToChapters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // cant found chapters table islam
        // Schema::table('chapters', function (Blueprint $table) {
        //     //
        //     $table->Integer('sequence')->nullable();
            
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('chapters', function (Blueprint $table) {
        //     //
        //     $table->dropColumn('sequence');
        // });
    }
}

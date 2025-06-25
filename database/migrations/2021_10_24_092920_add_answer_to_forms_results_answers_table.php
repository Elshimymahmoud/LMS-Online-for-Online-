<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnswerToFormsResultsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('results_answers', function (Blueprint $table) {
            //
            $table->text('answer')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     * change name of   forms_results_answers to  results_answers in drop @islam m. fadlallh
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::table('forms_results_answers', function (Blueprint $table) {
    //         //
    //         $table->dropColumn('answer');

    //     });
    // }

    public function down()
    {
        Schema::table('results_answers', function (Blueprint $table) {
            //
            $table->dropColumn('answer');

        });
    }
}

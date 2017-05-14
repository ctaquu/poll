<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePossibleAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('possible_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('question_id');
            $table->string('text');
            $table->timestamps();
        });

        Schema::table('possible_answers', function (Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('questions')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('possible_answers', function (Blueprint $table) {
            $table->dropForeign('possible_answers_question_id_foreign');
        });

        Schema::dropIfExists('possible_answers');
    }
}

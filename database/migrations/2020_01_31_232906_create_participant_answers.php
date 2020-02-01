<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_answers', function (Blueprint $table) {
            $table->bigIncrements('answer_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('participant_id');
            $table->string('answer', 256);
            $table->dateTime('time_submitted');

            $table->foreign('question_id')->references('question_id')->on('questions');
            $table->foreign('participant_id')->references('participant_id')->on('participants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_answers');
    }
}

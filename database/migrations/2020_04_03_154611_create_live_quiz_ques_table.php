<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveQuizQuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_quiz_ques', function (Blueprint $table) {
            $table->smallInteger('ques_serial_no');  
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('live_quiz_id');
            $table->primary(['question_id', 'live_quiz_id']);
            $table->timestamps();
            // $table->foreign('question_id')->references('id')->on('questions_bank');
            // $table->foreign('live_quiz_id')->references('id')->on('live_quizes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_quiz_ques');
    }
}

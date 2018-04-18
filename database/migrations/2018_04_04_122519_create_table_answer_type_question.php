<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAnswerTypeQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_type_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("type_question_id")->unsigned();
            $table->foreign('type_question_id')
            ->references('id')
            ->on('type_questions')
            ->onDelete('cascade');
            $table->string('answer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

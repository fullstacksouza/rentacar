<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("question_id")->unsigned();
            $table->foreign('question_id')
            ->references("id")
            ->on('searches')
            ->onDelete('cascade');
            $table->text("option");
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
        Schema::dropIfExists('answer_options');
    }
}

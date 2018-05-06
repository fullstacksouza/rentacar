<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteredActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('search_id')->unsigned();
            $table->foreign('search_id')
            ->references('id')
            ->on('searches')
            ->onDelete('cascade');
            $table->longText('action');
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
        Schema::dropIfExists('registered_actions');
    }
}

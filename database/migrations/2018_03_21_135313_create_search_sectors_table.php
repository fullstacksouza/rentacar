<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('search_id')->unsigned();
            $table->integer('sector_id')->unsigned();
            $table->foreign('search_id')
            ->references("id")
            ->on("searches")->onDelete('cascade');
            $table->foreign('sector_id')
            ->references("id")
            ->on("sectors")->onDelete('cascade');
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
        Schema::dropIfExists('search_sectors');
    }
}

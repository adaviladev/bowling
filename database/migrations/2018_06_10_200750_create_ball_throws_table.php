<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBallThrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ball_throws', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('frame_id');
            $table->foreign('frame_id')
                  ->references('id')
                  ->on('frames');
            $table->unsignedInteger('index');
            $table->string('score')
                  ->nullable();
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
        Schema::dropIfExists('throws');
    }
}

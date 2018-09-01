<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rolls', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('frame_id');
            $table->foreign('frame_id')
                  ->references('id')
                  ->on('frames');
            $table->unsignedInteger('pins');
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
        Schema::table('rolls', function (Blueprint $table) {
            $table->dropForeign(['frame_id']);
        });
        Schema::dropIfExists('rolls');
    }
}
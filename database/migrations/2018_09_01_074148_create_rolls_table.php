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
            $table->unsignedInteger('game_id');
            $table->unsignedInteger('pins');
            $table->boolean('pin_1')->default(false);
            $table->boolean('pin_2')->default(false);
            $table->boolean('pin_3')->default(false);
            $table->boolean('pin_4')->default(false);
            $table->boolean('pin_5')->default(false);
            $table->boolean('pin_6')->default(false);
            $table->boolean('pin_7')->default(false);
            $table->boolean('pin_8')->default(false);
            $table->boolean('pin_9')->default(false);
            $table->boolean('pin_10')->default(false);
            $table->timestamps();

            $table->foreign('game_id')
                  ->references('id')
                  ->on('games');
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
            $table->dropForeign(['game_id']);
        });
        Schema::dropIfExists('rolls');
    }
}

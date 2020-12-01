<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->integer('MP')->default(0);
            $table->integer('W')->default(0);
            $table->integer('D')->default(0);
            $table->integer('L')->default(0);
            $table->integer('GF')->default(0);
            $table->integer('GA')->default(0);
            $table->integer('GD')->default(0);
            $table->integer('Pts')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}

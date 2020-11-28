<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeagueInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_info', function (Blueprint $table) {
            $table->id();

            $table->integer('leagueId');
            $table->integer('userId');
            $table->string('clubId');
            $table->integer('MP');
            $table->integer('W');
            $table->integer('D');
            $table->integer('L');
            $table->integer('GF');
            $table->integer('GA');
            $table->integer('GD');
            $table->integer('Pts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('league_info');
    }
}

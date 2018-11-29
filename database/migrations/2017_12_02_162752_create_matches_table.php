<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('team1')->unsigned();
            $table->integer('team2')->unsigned();
            $table->integer('season_id')->unsigned();
            $table->integer('round')->unsigned();
            $table->boolean('played');
            $table->integer('goals_team1')->unsigned();
            $table->integer('goals_team2')->unsigned();
            $table->string('final');
            $table->timestamps();


            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->foreign('team1')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('team2')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}

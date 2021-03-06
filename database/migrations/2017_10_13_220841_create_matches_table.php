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
            $table->integer('first_team_id')->unsigned();
            $table->integer('second_team_id')->unsigned();
            $table->integer('first_team_score')->default(0);
            $table->integer('second_team_score')->default(0);

            $table->foreign('first_team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('second_team_id')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::dropIfExists('matches');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fingerprint');
            $table->string('answer', 10);
            $table->integer('vote_id');
            $table->integer('user_id');
            $table->timestamps();

            $table->foreign('vote_id')->references('id')->on('votes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vote_history');
    }
}

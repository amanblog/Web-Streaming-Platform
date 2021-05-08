<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistSongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_table', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->unsignedBigInteger('song_id');
             $table->foreign('song_id')->references('id')->on('songs');
             $table->unsignedBigInteger('playlist_id');
             $table->foreign('playlist_id')->references('id')->on('playlists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlist_table');
    }
}

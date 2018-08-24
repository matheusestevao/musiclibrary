<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBandArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('band_artists', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['Artist','Band']);
            $table->string('name')->unique();
            $table->string('image');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('genre_bands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('band_artist_id')->unsigned();
            $table->foreign('band_artist_id')->references('id')->on('band_artists');
            $table->integer('genre_id')->unsigned();
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genre_bands');
        Schema::dropIfExists('band_artists');
        
    }
}

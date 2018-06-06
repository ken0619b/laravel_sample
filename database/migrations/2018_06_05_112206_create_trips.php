<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('destination_id')->unsigned();
            $table->text('description');
            $table->date('best_season_from')->nullable();
            $table->date('best_season_to')->nullable();
            $table->string('hero_image_path')->nullable();
            $table->timestamps();

            //foreign_key
            $table->foreign('destination_id')
                    ->references('id')
                    ->on('destinations')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}

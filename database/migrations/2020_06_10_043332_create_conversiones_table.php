<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversiones', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('sexo');
            $table->foreign('sexo')->references('id')->on('gender')->onDelete('cascade');

            $table->unsignedBigInteger('escala');
            $table->foreign('escala')->references('id')->on('escalas')->onDelete('cascade');

            // p= puntuacion
            $table->smallInteger('puntuacion_cruda');
            $table->smallInteger('puntuacion_t');

//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversiones');
    }
}

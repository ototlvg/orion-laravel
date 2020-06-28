<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterpretacionesValidezTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interpretaciones_validez', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('escala');
            $table->foreign('escala')->references('id')->on('escalas')->onDelete('cascade');

//            $table->unsignedBigInteger('nivel');
//            $table->foreign('nivel')->references('id')->on('niveles')->onDelete('cascade');
            $table->string('nivel')->nullable();

            $table->tinyInteger('identificador');

            $table->string('puntuacion')->nullable();

            $table->string('utilidad')->nullable();
            $table->string('elevacion');
            $table->text('interpretacion')->nullable();


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
        Schema::dropIfExists('interpretaciones_validez');
    }
}

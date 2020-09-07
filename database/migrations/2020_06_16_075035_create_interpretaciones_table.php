<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterpretacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interpretaciones', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('escala');
            $table->foreign('escala')->references('id')->on('escalas')->onDelete('cascade');

            $table->unsignedBigInteger('nivel');
            $table->foreign('nivel')->references('id')->on('niveles')->onDelete('cascade');

            $table->text('interpretacion');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interpretaciones');
    }
}

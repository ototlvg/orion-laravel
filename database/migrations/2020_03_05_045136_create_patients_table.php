<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->string('apaterno');
            $table->string('amaterno');
            $table->unsignedBigInteger('gender');
            $table->foreign('gender')->references('id')->on('gender')->onDelete('cascade');
            $table->unsignedBigInteger('marital_status');
            $table->foreign('marital_status')->references('id')->on('marital_status')->onDelete('cascade');
            $table->date('birthday');
            $table->unsignedBigInteger('job');
            $table->foreign('job')->references('id')->on('job_titles')->onDelete('cascade');
            $table->string('email')->unique()->nullable();
//            $table->string('password')->nullable();
            $table->unsignedBigInteger('type')->default(1);
            $table->foreign('type')->references('id')->on('user_types')->onDelete('cascade');
            $table->boolean('survey_available')->default(1);
            $table->bigInteger('completed_surveys')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('patients');
    }
}

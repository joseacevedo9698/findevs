<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesarrolladorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desarrolladors', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('id_persona')->unsigned();
            $table->integer('Ocupacion')->unsigned();
            $table->integer('Disponibilidad')->unsigned();
            $table->integer('Experiencia');
            $table->string('Link_HV');
            $table->timestamps();
            $table->foreign('Ocupacion')->references('id')->on('ocupacions')->onDelete('cascade');
            $table->foreign('id_persona')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('Disponibilidad')->references('id')->on('disponibilidads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desarrolladors');
    }
}

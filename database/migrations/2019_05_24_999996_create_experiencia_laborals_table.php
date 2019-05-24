<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperienciaLaboralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencia_laborals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_desarrollador')->unsigned();
            $table->String('Nombre_empresa');
            $table->String('Cargo');
            $table->Date('Tiempo');
            $table->timestamps();
            $table->foreign('id_desarrollador')->references('id')->on('desarrolladors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiencia_laborals');
    }
}

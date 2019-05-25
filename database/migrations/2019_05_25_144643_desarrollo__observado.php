<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DesarrolloObservado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desarrollo_observados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_desarrollador')->unsigned();
            $table->integer('id_reclutador')->unsigned();
            $table->boolean('state');
            $table->timestamps();
            $table->primary(['id_desarrollador', 'id_reclutador']);
            $table->foreign('id_desarrollador')->references('id')->on('desarrolladors')->onDelete('cascade');
            $table->foreign('id_reclutador')->references('id')->on('reclutadors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desarrollo_observados');
    }
}

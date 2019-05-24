<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HvLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hv_links', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('url');
            $table->string('descripcion');
            $table->integer('id_desarrollador')->unsigned();
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
        Schema::dropIfExists('hv_links');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServicioPaquete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_paquete', function(Blueprint $table)
        {
            $table->unsignedInteger('Servicio');
            $table->unsignedInteger('Paquete');

            $table->foreign('Paquete')->references('id')->on('paquete')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('Servicio')->references('id')->on('servicio')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio_paquete');
    }
}

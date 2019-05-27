<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cita', function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('Fecha');
            $table->string('Hora', 10);
            $table->unsignedInteger('Cliente');
            $table->unsignedInteger('Empleado');
            $table->unsignedInteger('Servicio')->nullable();
            $table->unsignedInteger('Paquete')->nullable();

            $table->foreign('Cliente')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('Empleado')->references('id')->on('empleado')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('Servicio')->references('id')->on('servicio')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('Paquete')->references('id')->on('paquete')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cita');
    }
}

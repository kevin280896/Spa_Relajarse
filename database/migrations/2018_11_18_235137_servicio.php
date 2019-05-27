<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Servicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('Nombre', 50);
            $table->text('Descripcion');
            $table->integer('Costo')->unsigned();
            $table->string('Tipo', 50);
            $table->unsignedInteger('Empleado');

            $table->foreign('Empleado')->references('id')->on('empleado')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio');
    }
}

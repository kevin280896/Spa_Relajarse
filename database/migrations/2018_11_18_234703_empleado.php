<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Empleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombre', 50);
            $table->string('Telefono', 30);
            $table->string('Direccion', 100);
            $table->integer('CodigoP')->nullable();
            $table->integer('Sueldo')->nullable();
            $table->string('Puesto', 30)->nullable();
            $table->string('Imagen', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado');
    }
}

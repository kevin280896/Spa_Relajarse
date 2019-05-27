<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServicioProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_producto', function(Blueprint $table)
        {
            $table->unsignedInteger('Servicio');
            $table->unsignedInteger('Producto');

            $table->foreign('Servicio')->references('id')->on('servicio')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('Producto')->references('id')->on('producto')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio_producto');
    }
}

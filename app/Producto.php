<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;
    //Tabla en la base de datos a la que hace referencia
    protected $table = 'producto';
    //Llave primaria de la tabla empleado
    protected $primaryKey = 'id';
    //Bandera para activar los campos de fecha de creacion y actualizacion automatico
    public $timestamps = false;

    //Columnas de la tabla empleado
    protected $fillable = [
        'Nombre', 'Precio', 'Descripcion', 'cantidad', 'Imagen', 'Tipo'
    ];

    /**
     * Funciones que hacen referencia a las relaciones 1:N, 1:1 o N:M dependiendo el caso en la base de datos
     * La estructura es (Modelo al que se hace referencia, llave foranea, llave primaria)
     * belongsTo = Hace referencia a (la llave foranea esta en esta tabla)
     * hasMany = Tiene muchas (la lleve primaria de este modelo se esta usando como foranea en otro modelo)
     */
    public function servicio_producto() {
        return $this->hasMany(Servicio_Producto::class, 'Producto', 'id');
    }

}

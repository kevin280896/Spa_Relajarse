<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //Tabla en la base de datos a la que hace referencia
    protected $table = 'servicio';
    //Llave primaria de la tabla empleado
    protected $primaryKey = 'id';
    //Bandera para activar los campos de fecha de creacion y actualizacion automatico
    public $timestamps = false;

    //Columnas de la tabla empleado
    protected $fillable = [
        'Nombre', 'id', 'Descripcion', 'Costo', 'Tipo', 'Empleado'
    ];

    /**
     * Funciones que hacen referencia a las relaciones 1:N, 1:1 o N:M dependiendo el caso en la base de datos
     * La estructura es (Modelo al que se hace referencia, llave foranea, llave primaria)
     * belongsTo = Hace referencia a (la llave foranea esta en esta tabla)
     * hasMany = Tiene muchas (la lleve primaria de este modelo se esta usando como foranea en otro modelo)
     */
    public function servicio_producto() {
        return $this->hasMany(Servicio_Producto::class, 'Servicio', 'id');
    }

    public function empleados() {
        return $this->belongsTo(Empleado::class, 'Empleado', 'id');
    }

    public function cita() {
        return $this->hasMany(Cita::class, 'Servicio', 'id');
    }
    public function servicio_paquete() {
        return $this->hasMany(Servicio_Paquete::class, 'Servicio', 'id');
    }
}

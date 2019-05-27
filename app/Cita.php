<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    //Tabla en la base de datos a la que hace referencia
    protected $table = 'cita';
    //Llave primaria de la tabla empleado
    protected $primaryKey = 'id';
    //Bandera para activar los campos de fecha de creacion y actualizacion automatico
    public $timestamps = false;

    //Columnas de la tabla empleado
    protected $fillable = [
        'Fecha', 'Hora', 'Cliente', 'Empleado', 'Servicio', 'Paquete'
    ];

    /**
     * Funciones que hacen referencia a las relaciones 1:N, 1:1 o N:M dependiendo el caso en la base de datos
     * La estructura es (Modelo al que se hace referencia, llave foranea, llave primaria)
     * belongsTo = Hace referencia a (la llave foranea esta en esta tabla)
     * hasMany = Tiene muchas (la lleve primaria de este modelo se esta usando como foranea en otro modelo)
     */
    public function servicios() {
        return $this->belongsTo(Servicio::class, 'Servicio', 'id');
    }

    public function paquete() {
        return $this->belongsTo(Paquete::class, 'Paquete', 'id');
    }

    public function empleados() {
        return $this->belongsTo(empleado::class, 'Empleado', 'id');
    }
    public function clientes() {
        return $this->belongsTo(User::class, 'Cliente', 'id');
    }
}

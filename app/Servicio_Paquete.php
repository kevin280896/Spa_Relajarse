<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio_Paquete extends Model
{
    //Tabla en la base de datos a la que hace referencia
    protected $table = 'servicio_paquete';
    //Bandera para activar los campos de fecha de creacion y actualizacion automatico
    public $timestamps = false;

    //Columnas de la tabla empleado
    protected $fillable = [
        'Servicio', 'Paquete'
    ];

    /**
     * Funciones que hacen referencia a las relaciones 1:N, 1:1 o N:M dependiendo el caso en la base de datos
     * La estructura es (Modelo al que se hace referencia, llave foranea, llave primaria)
     * belongsTo = Hace referencia a (la llave foranea esta en esta tabla)
     * hasMany = Tiene muchas (la lleve primaria de este modelo se esta usando como foranea en otro modelo)
     */
    public function servicio() {
        return $this->belongsTo(Servicio::class, 'Servicio', 'id');
    }

    public function paquete() {
        return $this->belongsTo(Paquete::class, 'Paquete', 'id');
    }
}

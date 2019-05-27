<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        //Arreglo para poner el nombre del campo que se mostrara en caso de error
        return [
            'Nombre' => 'nombre',
            'Direccion' => 'dirección',
            'Puesto' => 'puesto',
            'Telefono' => 'telefono',
            'CodigoP' => 'código postal',
            'Sueldo' => 'sueldo',
            'Imagen' => 'imagen'
        ];
    }

    //Funcion para poner los mensajes de error
    public function messages()
    {
        //Arreglo que mostrara el mensaje de error dependiendo el campo y el tipo de error
        return [
            'Imagen.required' => 'La :attribute es obligatoria.',
            'Nombre.required' => 'El :attribute es obligatorio.',
            'Direccion.required' => 'La :attribute es obligatoria.',
            'Puesto.required' => 'El :attribute es obligatorio.',
            'Telefono.required' => 'El :attribute es obligatorio.',
            'CodigoP.required' => 'El :attribute es obligatorio.',
            'Sueldo.required' => 'El :attribute es obligatorio.'
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Nombre' => 'required',
            'Telefono' => 'required',
            'Direccion' => 'required',
            'CodigoPostal' => 'required',
            'Sueldo' => 'required',
            'Puesto' => 'required',
            'Imagen' => 'required'
        ];
    }
}

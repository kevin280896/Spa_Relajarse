<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
            'Precio' => 'precio',
            'Tipo' => 'tipo de producto',
            'Descripcion' => 'descripción',
        ];
    }

    //Funcion para poner los mensajes de error
    public function messages()
    {
        //Arreglo que mostrara el mensaje de error dependiendo el campo y el tipo de error
        return [
            'Imagen.required' => 'La :attribute es obligatoria.',
            'Nombre.required' => 'El :attribute es obligatoria.',
            'Nombre.string' => 'El :attribute debe ser una cadena de texto.',
            'cantidad.required' => 'La :attribute es obligatoria.',
            'Precio.required' => 'El :attribute es obligatorio.',
            'Tipo.required' => 'El :attribute es requerido.',
            'Descripcion.required' => 'La :attribute es requerida.',
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
            'Nombre' => 'required|string',
            'Precio' => 'required',
            'cantidad' => 'required',
            'Imagen' => 'required',
            'Tipo' => 'required',
            'Descripcion' => 'required'
        ];
    }
}

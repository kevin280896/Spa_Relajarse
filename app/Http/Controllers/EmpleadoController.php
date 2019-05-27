<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Http\Requests\EmpleadoRequest;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::get();

        return view('empleado.index', ['empleados' => $empleados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    public function store(EmpleadoRequest $request)
    {
        if ($request->hasFile('Imagen')) {
            //Extension de la imagen
            $extension = "png";
            //se agrega el codigo del usuario mas la extension
            $file_name = str_random(12) . '.' . $extension;
            //Tamaño maximo de la imagen
            $width = 200;
            $height = 200;
            //Creamos el objeto de la imagen con la imagen ingresada por el usuario
            $img = Image::make($request->file('Imagen'));
            //Operacion para borra el ancho o alto de la imagen para mantener la proporcion
            $img->height() > $img->width() ? $width = null : $height = null;
            //Redimensionamos la imagen con un tamaño menos pero manteniendo la proporcion
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            //Guardamos la nueva imagen en la carpeta imagenes
            $img->save('imagenes/' . $file_name);

            Empleado::create([
                'Nombre' => request()->Nombre,
                'Direccion' => request()->Direccion,
                'Telefono' => request()->Telefono,
                'CodigoP' => request()->CodigoPostal,
                'Sueldo' => request()->Sueldo,
                'Puesto' => request()->Puesto,
                'Imagen' => $file_name,
            ]);

            return redirect()->route('empleado.index')->with('success', 'Se ha creado el empleado.');
        } else {
            Empleado::create([
                'Nombre' => request()->Nombre,
                'Direccion' => request()->Direccion,
                'Telefono' => request()->Telefono,
                'CodigoP' => request()->CodigoPostal,
                'Sueldo' => request()->Sueldo,
                'Puesto' => request()->Puesto,
            ]);

            return redirect()->route('empleado.index')->with('success', 'Se ha creado el empleado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $empleado = Empleado::findOrFail(request()->id);

        return $empleado;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);

        return view('empleado.edit', ['empleado' => $empleado]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);
        //Validamos si puso una imagen
        if ($request->hasFile('Imagen')) {
            \Illuminate\Support\Facades\File::delete('imagenes/'.$empleado->Imagen);
            //Extension de la imagen
            $extension="png";
            //se agrega el codigo del usuario mas la extension
            $file_name = str_random(10) . '.' . $extension;
            $empleado->update(['Imagen' => $file_name]);
            //Tamaño maximo de la imagen
            $width = 200;
            $height = 200;
            //Creamos el objeto de la imagen con la imagen ingresada por el usuario
            $img = Image::make($request->file('Imagen'));
            //Operacion para borra el ancho o alto de la imagen para mantener la proporcion
            $img->height() > $img->width() ? $width=null : $height=null;
            //Redimensionamos la imagen con un tamaño menos pero manteniendo la proporcion
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            //Guardamos la nueva imagen en la carpeta imagenes
            $img->save('imagenes/' . $file_name);
        }

        //Actualizamos en la base de datos con los campos del formulario
        $empleado->update($request->except(['Imagen']));

        //Redirigimos a la pagina principal con la alerta de que se actualizo el perfil
        return redirect()->route('empleado.index')->with('success', 'Se ha actualizado el empleado.');
    }

    public function destroy()
    {
        $empleado = Empleado::findOrFail(request()->idEmpleado);
        \Illuminate\Support\Facades\File::delete('imagenes/'.$empleado->Imagen);
        Empleado::destroy(request()->idEmpleado);

        return redirect()->route('empleado.index')->with('success', 'Se ha eliminado el empleado.');
    }
}

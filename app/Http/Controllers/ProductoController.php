<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Producto;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productosB = Producto::where('Tipo', 'Belleza')->paginate(1);
        $productosR = Producto::where('Tipo', 'Relajacion')->paginate(1);

        return view('producto.index', ['productosB' => $productosB, 'productosR' => $productosR]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('producto.create');
    }

    public function store(ProductoRequest $request)
    {
        //Extension de la imagen
        $extension="png";
        //se agrega el codigo del usuario mas la extension
        $file_name = str_random(10) . '.' . $extension;
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

        Producto::create([
            'Nombre' => request()->Nombre,
            'Descripcion' => request()->Descripcion,
            'Precio' => request()->Precio,
            'cantidad' => request()->cantidad,
            'Imagen' => $file_name,
            'Tipo' => $request->get('Tipo')
        ]);

        return redirect()->route('producto.index')->with('success', 'Se ha creado el producto.');
    }

    public function show()
    {
        $producto = Producto::findOrFail(request()->id);

        return $producto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        return view('producto.edit', ['producto' => $producto]);
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
        $producto = Producto::findOrFail($id);
        //Validamos si puso una imagen
        if ($request->hasFile('Imagen')) {
            \Illuminate\Support\Facades\File::delete('imagenes/'.$producto->Imagen);
            //Extension de la imagen
            $extension="png";
            //se agrega el codigo del usuario mas la extension
            $file_name = str_random(10) . '.' . $extension;
            $producto->update(['Imagen' => $file_name]);
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
        $producto->update($request->except(['Imagen']));

        //Redirigimos a la pagina principal con la alerta de que se actualizo el perfil
        return redirect()->route('producto.index')->with('success', 'Se ha actualizado el producto.');
    }

    public function destroy()
    {
        $producto = Producto::findOrFail(request()->idProducto);
        \Illuminate\Support\Facades\File::delete('imagenes/'.$producto->Imagen);
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Se ha eliminado el producto.');
    }
}

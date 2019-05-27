<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Producto;
use App\Servicio;
use App\Servicio_Producto;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicioM = Servicio::where('Tipo', 'Masaje')->with('empleados')->get();
        $servicioF = Servicio::where('Tipo', 'Facial')->with('empleados')->get();

        return view('servicio.index', ['serviciosM' => $servicioM, 'serviciosF' => $servicioF]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados = Empleado::get();

        return view('servicio.create', ['empleados' => $empleados]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $servicio = Servicio::create($request->all());

        return redirect()->route('servicio.productos', $servicio->id);
    }

    public function productos($id) {
        $servicio = Servicio::findOrFail($id);
        $productosB = Producto::where('Tipo', 'Belleza')->get();
        $productosR = Producto::where('Tipo', 'Relajacion')->get();

        return view('servicio.indexProd', ['productosB' => $productosB, 'productosR' => $productosR, 'servicio' => $servicio]);
    }

    public function agregarProductos($id) {
//        dd(request()->productos);
        foreach (request()->productos as $idProducto) {
            Servicio_Producto::create([
                'Servicio' => $id,
                'Producto' => $idProducto
            ]);
        }

        return redirect()->route('servicio.index')->with('success', 'Se ha creado el servicio.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function destroy()
    {
        Servicio::destroy(request()->idServicio);

        return redirect()->route('servicio.index')->with('success', 'Se ha eliminado el servicio.');
    }
}

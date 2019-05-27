<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Empleado;
use App\Servicio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use  Illuminate\Support\Facades\Mail;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citasAdmin = Cita::with('empleados')->with('servicios')->with('clientes')->get();
        $citasUser = Cita::where('Cliente', Auth::user()->id)->with('empleados')->with('servicios')->get();
        $citasEmpleado = Cita::with('clientes')->with('servicios')->get();

        return view('cita.index', ['citasAdmin' => $citasAdmin, 'citasUser' => $citasUser, 'citasEmpleado' => $citasEmpleado]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados = Empleado::get();
        $clientes = User::where('Tipo', 'Usuario')->get();
        $servicios = Servicio::get();

        return view('cita.create', ['empleados' => $empleados, 'clientes' => $clientes, 'servicios' => $servicios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existe = Cita::where('Empleado', request()->Empleado)->where('Fecha', request()->Fecha)->where('Hora', request()->Hora)->first();

        if($existe == null) {
            $cita = Cita::create(request()->except('EsCliente'));

            if(request()->EsCliente == 1) {
//                $datos = DB::table('cita as c')
//                    ->where('c.id', $cita->id)
//                    ->select('p.Nombre as Producto', 'p.Imagen as ImagenP', 'e.Nombre as Empleado', 'e.Imagen as ImagenP',
//                        's.Nombre as NombreS', 's.Descripcion', 's.Costo', 'c.Fecha', 'c.Hora', 'u.name', 'u.mail')
//                    ->join('servicio as s', 's.id', '=', $cita->Servicio)
//                    ->join('servicio_producto as sp', 'sp.Servicio', '=', 's.id')
//                    ->join('empleado as e', 'e.id', '=', $cita->Empleado)
//                    ->join('users as u', 'u.id', '=', $cita->Cliente)
//                    ->join('producto as p', 'p.id', '=', 'sp.Producto');

                $datos = Cita::where('id', $cita->id)->with('servicios')->with('empleados')->with('clientes')->first();
                $pdf = \PDF::loadView('cita.pdf', ['cita' => $datos]);
                $info = [
                    'Fecha' => $datos->Fecha,
                    'Hora' => $datos->Hora,
                    'Empleado' => $datos->empleados->Nombre,
                    'Cliente' => $datos->clientes->name,
                    'Servicio' => $datos->servicios->Nombre
                ];
                file_put_contents("img/cita.pdf", $pdf->output());
                Mail::send('emails.pdf', $info, function ($message) {
                    $message->attach('img/cita.pdf');
                    $message->to(Auth::user()->email)->subject('Spa-Relajarse');
                });
                \Illuminate\Support\Facades\File::delete('img/cita.pdf');
            }

            return redirect()->route('cita.index')->with('success', 'Se ha creado la cita.');
        } else {
            return back()->withInput()->with('error', 'No esta disponible la hora en que solicito la cita.');
        }
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cita::destroy(request()->idCita);

        return redirect()->route('cita.index')->with('success', 'Se ha eliminado ela cita.');
    }
}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 text-right">
                            <a href="{{ route('cita.create') }}" class="btn btn-primary" id="btnCrearCita">Nueva cita</a>
                            <center><img src="{{ asset('img/logomail.png') }}" style="width: 15%; margin-top: -40px;"></center>
                        </div>
                        <br>
                        @if (Auth::user()->Tipo == 'Admin')
                            @if (empty($citasAdmin->toArray()))
                                <h3 style="color: #123c24">Aún no se cuenta con ninguna cita registrada.</h3>
                            @else
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="buscar" class="col-md-4 col-form-label text-md-right" style="display: none"></label>
                                        <input id="filtrar" type="text" class="form-control{{ $errors->has('buscar') ? ' is-invalid' : '' }}" name="filtrar" value="{{ old('buscar') }}" autofocus placeholder="Buscar">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover compact hover row-border w-100" id="tablaUniver">
                                        <thead style="background: #123c24; color: white">
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Cliente</th>
                                            <th>Empleado</th>
                                            <th>Servicio</th>
                                        </thead>
                                        <tbody class="buscar">
                                        @foreach($citasAdmin as $cita)
                                            <tr>
                                                <td>{{ $cita->Fecha }}</td>
                                                <td>{{ $cita->Hora }}</td>
                                                <td>{{ $cita->clientes->name }}</td>
                                                <td>{{ $cita->empleados->Nombre }}</td>
                                                <td>{{ $cita->servicios->Nombre }}</td>
                                                <td>
                                                    <a onclick="eliminar({{ $cita->id }})"><img src="{{ asset('img/delete.png') }}" ></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endif
                        @if (Auth::user()->Tipo == 'Empleado')
                            @if (empty($citasEmpleado->toArray()))
                                <h3 style="color: #123c24">Aún no se cuenta con ninguna cita pendiente.</h3>
                            @else
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="buscar" class="col-md-4 col-form-label text-md-right" style="display: none"></label>
                                        <input id="filtrar" type="text" class="form-control{{ $errors->has('buscar') ? ' is-invalid' : '' }}" name="filtrar" value="{{ old('buscar') }}" autofocus placeholder="Buscar">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover compact hover row-border w-100" id="tablaUniver">
                                        <thead style="background: #123c24; color: white">
                                            <th>Fecha</th>
                                            <th >Hora</th>
                                            <th>Cliente</th>
                                            <th>Servicio</th>
                                        </thead>
                                        <tbody class="buscar">
                                        @foreach($citasEmpleado as $cita)
                                            <tr>
                                                <td>{{ $cita->Fecha }}</td>
                                                <td>{{ $cita->Hora }}</td>
                                                <td>{{ $cita->clientes->name }}</td>
                                                <td>{{ $cita->servicios->Nombre }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endif
                        @if (Auth::user()->Tipo == 'Usuario')
                            @if (empty($citasUser->toArray()))
                                <h3 style="color: #123c24">Aún no se cuenta con ninguna cita registrada.</h3>
                            @else
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="buscar" class="col-md-4 col-form-label text-md-right" style="display: none"></label>
                                        <input id="filtrar" type="text" class="form-control{{ $errors->has('buscar') ? ' is-invalid' : '' }}" name="filtrar" value="{{ old('buscar') }}" autofocus placeholder="Buscar">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover compact hover row-border w-100" id="tablaUniver">
                                        <thead style="background: #123c24; color: white">
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Empleado</th>
                                            <th>Servicio</th>
                                        </thead>
                                        <tbody class="buscar">
                                        @foreach($citasUser as $cita)
                                            <tr>
                                                <td>{{ $cita->Fecha }}</td>
                                                <td>{{ $cita->Hora }}</td>
                                                <td>{{ $cita->empleados->Nombre }}</td>
                                                <td>{{ $cita->servicios->Nombre }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--@include('empleado.eliminar')--}}
    {{--@include('empleado.show')--}}

    <script>
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
        function eliminar(id) {
            $('#eliminar').modal('show');
            document.getElementById('idCita').value=id;
        }
    </script>
@endsection

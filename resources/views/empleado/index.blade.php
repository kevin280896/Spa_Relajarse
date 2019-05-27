@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 text-right">
                            <a href="{{ route('empleado.create') }}" class="btn btn-primary" id="btnCrearProducto">Nuevo empleado</a>
                            <center><img src="{{ asset('img/logomail.png') }}" style="width: 15%; margin-top: -40px;"></center>
                        </div>
                        <br>
                        @if (empty($empleados->toArray()))
                            <h3 style="color: #123c24">Aún no cuenta con ningún empleado registrado</h3>
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
                                        <th style="width: 400px;">Nombre</th>
                                        <th style="width: 200px;">Telefono</th>
                                        <th style="width: 200px;">Puesto</th>
                                        <th style="width: 150px;">Sueldo</th>
                                    </thead>
                                    <tbody class="buscar">
                                    @foreach($empleados as $empleado)
                                        <tr>
                                            <td>{{ $empleado->Nombre }}</td>
                                            <td>{{ $empleado->Telefono }}</td>
                                            <td>{{ $empleado->Puesto }}</td>
                                            <td>{{ $empleado->Sueldo }}</td>
                                            <td>
                                                <a onclick="mostrar({{ $empleado->id }})"><img src="{{ asset('img/ver.png') }}" ></a>
                                                <a href="{{ route('empleado.edit', $empleado->id) }}"><img src="{{ asset('img/edit.png') }}" ></a>
                                                <a onclick="eliminar({{ $empleado->id }})"><img src="{{ asset('img/delete.png') }}" ></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('empleado.eliminar')
    @include('empleado.show')

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
            document.getElementById('idEmpleado').value=id;
        }

        function mostrar(id) {
            $('#loading').show();
            $('#info').hide();
            $('#mostrar').modal('show');
            $.ajax({
                url: '{{ route('empleado.show') }}',
                method:'GET',
                data: {'id':id},
                dataType: "json",
                success:function(data){
                    $('#loading').hide();
                    $('#info').show();
                    $('#nombre').text(data.Nombre);
                    $('#direccion').text('Dirección: '+data.Direccion);
                    $('#telefono').text('Telefono: $'+data.Telefono);
                    $('#puesto').text('Puesto: '+data.Puesto);
                    $('#sueldo').text('Sueldo: '+data.Sueldo);
                    $('#codigo').text('Codigo Postal: '+data.CodigoP);
                    $("#imagen").attr("src","imagenes/"+data.Imagen);
                }
            });
        }
    </script>
@endsection

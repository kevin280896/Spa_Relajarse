@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 text-right">
                            <a href="{{ route('servicio.create') }}" class="btn btn-primary" id="btnCrearProducto">Crear servicio</a>
                            <center><img src="{{ asset('img/logomail.png') }}" style="width: 15%; margin-top: -40px;"></center>
                        </div>
                        <br>
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Masajes</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Faciales</a>
                            </div>
                        </nav>
                        <br>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="container">
                                    <div class="row">
                                        @if(empty($serviciosM->toArray()))
                                            <h3 style="color: #123c24">Aún no cuenta con ningún servicio registrado</h3>
                                        @else
                                            <label for="buscar" class="col-md-12 col-form-label text-md-right" style="display: none"></label>
                                            <input id="filtrar" type="text" class="form-control{{ $errors->has('buscar') ? ' is-invalid' : '' }}" name="filtrar" value="{{ old('buscar') }}" autofocus placeholder="Buscar">
                                            <br>
                                            <div class="table-responsive" style="margin-top: 10px">
                                                <table class="table table-striped table-hover compact hover row-border w-100">
                                                    <thead style="background: #123c24; color: white">
                                                        <th style="width: 400px;">Nombre</th>
                                                        <th style="width: 160px;">Costo</th>
                                                        <th style="width: 400px;">Masajista</th>
                                                    </thead>
                                                    <tbody class="buscar">
                                                    @foreach($serviciosM as $serv)
                                                        <tr>
                                                            <td>{{ $serv->Nombre }}</td>
                                                            <td>{{ $serv->Costo }}</td>
                                                            <td>{{ $serv->empleados->Nombre }}</td>
                                                            <td>
                                                                {{--<a onclick="mostrar({{ $serv->id }})"><img src="{{ asset('img/ver.png') }}" ></a>--}}
                                                                @auth
                                                                    @if (Auth::user()->Tipo == 'Empleado')
                                                                        {{--<a href="{{ route('servicio.edit', $serv->id) }}"><img src="{{ asset('img/edit.png') }}" ></a>--}}
                                                                    @endif
                                                                    @if (Auth::user()->Tipo == 'Admin')
                                                                        {{--<a href="{{ route('servicio.edit', $serv->id) }}"><img src="{{ asset('img/edit.png') }}" ></a>--}}
                                                                        <a onclick="eliminar({{ $serv->id }})"><img src="{{ asset('img/delete.png') }}" ></a>
                                                                    @endif
                                                                @endauth
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
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="container">
                                    <div class="row">
                                        @if(empty($serviciosF->toArray()))
                                            <h3 style="color: #123c24">Aún no cuenta con ningún servicio registrado</h3>
                                        @else
                                            <label for="buscar" class="col-md-12 col-form-label text-md-right" style="display: none"></label>
                                            <input id="filtrar" type="text" class="form-control{{ $errors->has('buscar') ? ' is-invalid' : '' }}" name="filtrar" value="{{ old('buscar') }}" autofocus placeholder="Buscar">
                                            <br>
                                            <div class="table-responsive" style="margin-top: 10px;">
                                                <table class="table table-striped table-hover compact hover row-border w-100">
                                                    <thead style="background: #123c24; color: white">
                                                        <th style="width: 400px;">Nombre</th>
                                                        <th style="width: 160px;">Costo</th>
                                                        <th style="width: 400px;">Masajista</th>
                                                    </thead>
                                                    <tbody class="buscar">
                                                    @foreach($serviciosF as $serv)
                                                        <tr>
                                                            <td>{{ $serv->Nombre }}</td>
                                                            <td>{{ $serv->Costo }}</td>
                                                            <td>{{ $serv->empleados->Nombre }}</td>
                                                            <td>
                                                                {{--<a onclick="mostrar({{ $serv->id }})"><img src="{{ asset('img/ver.png') }}" ></a>--}}
                                                                @auth
                                                                    @if (Auth::user()->Tipo == 'Empleado')
                                                                        {{--<a href="{{ route('servicio.edit', $serv->id) }}"><img src="{{ asset('img/edit.png') }}" ></a>--}}
                                                                    @endif
                                                                    @if (Auth::user()->Tipo == 'Admin')
                                                                        {{--<a href="{{ route('servicio.edit', $serv->id) }}"><img src="{{ asset('img/edit.png') }}" ></a>--}}
                                                                        <a onclick="eliminar({{ $serv->id }})"><img src="{{ asset('img/delete.png') }}" ></a>
                                                                    @endif
                                                                @endauth
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
                </div>
            </div>
        </div>
    </div>

    @include('servicio.eliminar')
    {{--@include('producto.show')--}}
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
            document.getElementById('idServicio').value=id;
        }

        function mostrar(id) {
            $('#loading').show();
            $('#info').hide();
            $('#mostrar').modal('show');
            $.ajax({
                url: '{{ route('producto.show') }}',
                method:'GET',
                data: {'id':id},
                dataType: "json",
                success:function(data){
                    $('#loading').hide();
                    $('#info').show();
                    $('#producto').text(data.Nombre);
                    $('#descripcion').text('Descripción: '+data.Descripcion);
                    $('#precio').text('Precio: $'+data.Precio);
                    $('#cantidad').text('Cantidad: '+data.cantidad);
                    $('#tipo').text('Tipo: '+data.Tipo);
                    $("#imagen").attr("src","imagenes/"+data.Imagen);
                }
            });
        }
    </script>
@endsection

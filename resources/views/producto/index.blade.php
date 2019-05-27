@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 text-right">
                            <br>
                            <center><img src="{{ asset('img/logomail.png') }}" style="width: 15%; margin-top: -40px;"></center>
                            @auth
                                @if(Auth::user()->Tipo != 'Usuario')
                                    <a href="{{ route('producto.create') }}" class="btn btn-primary" id="btnCrearProducto">Crear producto</a>
                                @endif
                            @endauth
                        </div>
                        <br>
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Belleza</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Relajación</a>
                            </div>
                        </nav>
                        <br>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="container">
                                    <div class="row">
                                        @if(empty($productosB->toArray()))
                                            <h3 style="color: #123c24">Aún no cuenta con ningún producto registrado</h3>
                                        @else
                                            @foreach($productosB as $prod)
                                                <div class="card" style="width: 9rem; border-color: #1d643b; margin-left: 7px; margin-bottom: 7px;">
                                                    <img class="card-img-top" src="{{ asset('imagenes/')}}/{{ $prod->Imagen }}" alt="Error">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $prod->Nombre }}</h5>
                                                        <p class="card-text">Costo: ${{ $prod->Precio }}</p>
                                                        <a onclick="mostrar({{ $prod->id }})"><img src="{{ asset('img/ver.png') }}" ></a>
                                                        @auth
                                                            @if (Auth::user()->Tipo == 'Empleado')
                                                                <a href="{{ route('producto.edit', $prod->id) }}"><img src="{{ asset('img/edit.png') }}" ></a>
                                                            @endif
                                                            @if (Auth::user()->Tipo == 'Admin')
                                                                <a href="{{ route('producto.edit', $prod->id) }}"><img src="{{ asset('img/edit.png') }}" ></a>
                                                                <a onclick="eliminar({{ $prod->id }})"><img src="{{ asset('img/delete.png') }}" ></a>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <br>
                                {{ $productosB->links() }}
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="container">
                                    <div class="row">
                                        @if(empty($productosR->toArray()))
                                            <h3 style="color: #123c24">Aún no cuenta con ningún producto registrado</h3>
                                        @else
                                            @foreach($productosR as $produ)
                                                <div class="card" style="width: 9rem; border-color: #1d643b; margin-left: 7px; margin-bottom: 7px;">
                                                    <img class="card-img-top" src="{{ asset('imagenes/')}}/{{ $produ->Imagen }}" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $produ->Nombre }}</h5>
                                                        <p class="card-text">Costo: ${{ $produ->Precio }}</p>
                                                        <a onclick="mostrar({{ $produ->id }})"><img src="{{ asset('img/ver.png') }}" ></a>
                                                        @auth
                                                            @if (Auth::user()->Tipo == 'Empleado')
                                                                <a href="{{ route('producto.edit', $produ->id) }}"><img src="{{ asset('img/edit.png') }}" ></a>
                                                            @endif
                                                            @if (Auth::user()->Tipo == 'Admin')
                                                                <a href="{{ route('producto.edit', $produ->id) }}"><img src="{{ asset('img/edit.png') }}" ></a>
                                                                <a onclick="eliminar({{ $produ->id }})"><img src="{{ asset('img/delete.png') }}" ></a>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                {{ $productosR->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('producto.eliminar')
    @include('producto.show')
    <script>
        function eliminar(id) {
            $('#eliminar').modal('show');
            document.getElementById('idProducto').value=id;
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

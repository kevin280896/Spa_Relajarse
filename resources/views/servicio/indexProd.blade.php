@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <br>
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Belleza</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Relajación</a>
                            </div>
                        </nav>
                        <br>
                        <div class="tab-content" id="nav-tabContent">
                            <form method="POST" action="{{ route('servicio.agregarProd', $servicio->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <p>Seleccione los productos que desea agregar a {{ $servicio->Nombre }}</p>
                                    @if(empty($productosB->toArray()))
                                        <h3 style="color: #123c24">Aún no cuenta con ningún producto registrado</h3>
                                    @else
                                        <div class="container">
                                            <div class="row">
                                                @foreach($productosB as $prod)
                                                    <div class="card" style="width: 10rem; border-color: #1d643b; margin-left: 7px; margin-bottom: 7px;">
                                                        <img class="card-img-top" src="{{ asset('imagenes/')}}/{{ $prod->Imagen }}" alt="Error">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $prod->Nombre }}</h5>
                                                            <p class="card-text">Costo: ${{ $prod->Precio }}</p>
                                                            <input type="checkbox" value="{{ $prod->id }}" name="productos[]">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <p>Seleccione los productos que desea agregar a {{ $servicio->Nombre }}</p>
                                    @if(empty($productosR->toArray()))
                                        <h3 style="color: #123c24">Aún no cuenta con ningún producto registrado</h3>
                                    @else
                                        <div class="container">
                                            <div class="row">
                                                @foreach($productosR as $produ)
                                                    <div class="card" style="width: 8rem; border-color: #1d643b; margin-left: 7px; margin-bottom: 7px;">
                                                        <img class="card-img-top" src="{{ asset('imagenes/')}}/{{ $produ->Imagen }}" alt="Card image cap">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $produ->Nombre }}</h5>
                                                            <p class="card-text">Costo: ${{ $produ->Precio }}</p>
                                                            <input type="checkbox" value="{{ $produ->id }}" name="productos[]">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-11">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Guardar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Producto') }}</div>

                    <div class="card-body">
                        <center><img src="{{ asset('img/logomail.png') }}" style="width: 30%;"></center>
                        <br>
                        <form method="POST" action="{{ route('producto.update', $producto->id) }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <div class="form-group row">
                                <label for="Nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="Nombre" type="text" class="form-control{{ $errors->has('Nombre') ? ' is-invalid' : '' }}" name="Nombre" value="{{ $producto->Nombre }}" autofocus>

                                    @if ($errors->has('Nombre'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Nombre') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Descripcion" class="col-md-4 col-form-label text-md-right">Descripción</label>

                                <div class="col-md-6">
                                    <textarea name="Descripcion" id="Descripcion" class="form-control{{ $errors->has('Descripcion') ? ' is-invalid' : '' }}" rows="4" autofocus>{{ $producto->Descripcion }}</textarea>

                                    @if ($errors->has('Descripcion'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Descripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Precio" class="col-md-4 col-form-label text-md-right">{{ __('Precio') }}</label>

                                <div class="col-md-6">
                                    <input id="Precio" type="text" class="form-control{{ $errors->has('Precio') ? ' is-invalid' : '' }}" name="Precio" value="{{ $producto->Precio }}">

                                    @if ($errors->has('Precio'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Precio') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cantidad" class="col-md-4 col-form-label text-md-right">{{ __('Cantidad') }}</label>

                                <div class="col-md-6">
                                    <input id="cantidad" type="text" class="form-control{{ $errors->has('cantidad') ? ' is-invalid' : '' }}" name="cantidad" value="{{ $producto->cantidad }}">

                                    @if ($errors->has('cantidad'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cantidad') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

                                <div class="col-md-6">
                                    <select name="Tipo" id="Tipo" class="selectpicker form-group">
                                        @if ($producto->Tipo == 'Belleza')
                                            <option value="Belleza">Belleza</option>
                                            <option value="Relajacion">Relajacion</option>
                                        @else
                                            <option value="Relajacion">Relajacion</option>
                                            <option value="Belleza">Belleza</option>
                                        @endif
                                    </select>

                                    @if ($errors->has('Tipo'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Tipo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Imagen" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>

                                <div class="col-md-6">
                                    <img src="{{ asset('imagenes/')}}/{{ $producto->Imagen }}" id="perf">
                                    <img id="prev" style="width: 40%;">
                                    <input type="hidden" id="Img" name="img" value="0">
                                    <br>
                                    <input type="file" class="form-control{{ $errors->has('Imagen') ? ' is-invalid' : '' }}" id="Imagen" name="Imagen" accept=".png, .jpg, .jpeg" style="border: none"/>
                                    @if ($errors->has('Imagen'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Imagen') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-10">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#prev').hide();
            function readURL(input) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $('#prev').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
                document.getElementById("Imagen").style.width = "85px";
            }
            $("#Imagen").change(function(){
                readURL(this);
                $('#prev').show();
                $('#perf').hide();
            });
        });
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Nuevo Empleado') }}</div>

                    <div class="card-body">
                        <center><img src="{{ asset('img/logomail.png') }}" style="width: 30%;"></center>
                        <br>
                        <form method="POST" action="{{ route('empleado.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="Nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="Nombre" type="text" class="form-control{{ $errors->has('Nombre') ? ' is-invalid' : '' }}" name="Nombre" value="{{ old('Nombre') }}" autofocus>

                                    @if ($errors->has('Nombre'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Nombre') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Direccion" class="col-md-4 col-form-label text-md-right">Dirección</label>

                                <div class="col-md-6">
                                    <input id="Direccion" type="text" class="form-control{{ $errors->has('Direccion') ? ' is-invalid' : '' }}" name="Direccion" value="{{ old('Direccion') }}" autofocus>

                                    @if ($errors->has('Direccion'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Direccion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="CodigoPostal" class="col-md-4 col-form-label text-md-right">Código Postal</label>

                                <div class="col-md-6">
                                    <input id="CodigoPostal" type="text" class="form-control{{ $errors->has('CodigoPostal') ? ' is-invalid' : '' }}" name="CodigoPostal" value="{{ old('CodigoPostal') }}" autofocus>

                                    @if ($errors->has('CodigoPostal'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('CodigoPostal') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Telefono" class="col-md-4 col-form-label text-md-right">Telefono</label>

                                <div class="col-md-6">
                                    <input id="Telefono" type="text" class="form-control{{ $errors->has('Telefono') ? ' is-invalid' : '' }}" name="Telefono" value="{{ old('Telefono') }}" autofocus>

                                    @if ($errors->has('Telefono'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Telefono') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Puesto" class="col-md-4 col-form-label text-md-right">Puesto</label>

                                <div class="col-md-6">
                                    <input id="Puesto" type="text" class="form-control{{ $errors->has('Puesto') ? ' is-invalid' : '' }}" name="Puesto" value="{{ old('Puesto') }}" autofocus>

                                    @if ($errors->has('Puesto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Puesto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Sueldo" class="col-md-4 col-form-label text-md-right">Sueldo</label>

                                <div class="col-md-6">
                                    <input id="Sueldo" type="text" class="form-control{{ $errors->has('Sueldo') ? ' is-invalid' : '' }}" name="Sueldo" value="{{ old('Sueldo') }}" autofocus>

                                    @if ($errors->has('Sueldo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Sueldo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Imagen" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>

                                <div class="col-md-6">
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
                                <div class="col-md-6 offset-md-9">
                                    <a href="{{ route('empleado.index') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Crear') }}
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

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Crear servicio') }}</div>

                    <div class="card-body">
                        <center><img src="{{ asset('img/logomail.png') }}" style="width: 30%;"></center>
                        <br>
                        <form method="POST" action="{{ route('servicio.store') }}" enctype="multipart/form-data">
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
                                <label for="Descripcion" class="col-md-4 col-form-label text-md-right">Descripción</label>

                                <div class="col-md-6">
                                    <textarea name="Descripcion" id="Descripcion" class="form-control{{ $errors->has('Descripcion') ? ' is-invalid' : '' }}" rows="4" value="{{ old('Descripcion') }}" autofocus></textarea>

                                    @if ($errors->has('Descripcion'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Descripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Costo" class="col-md-4 col-form-label text-md-right">{{ __('Costo') }}</label>

                                <div class="col-md-6">
                                    <input id="Costo" type="text" class="form-control{{ $errors->has('Costo') ? ' is-invalid' : '' }}" name="Costo" value="{{ old('Costo') }}">

                                    @if ($errors->has('Costo'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Costo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

                                <div class="col-md-6">
                                    <select name="Tipo" id="Tipo" class="selectpicker form-group" title="Selecciona una opción">
                                        <option value="Masaje">Masaje</option>
                                        <option value="Facial">Facial</option>
                                    </select>

                                    @if ($errors->has('Tipo'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Tipo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Empleado" class="col-md-4 col-form-label text-md-right">{{ __('Empleado') }}</label>

                                <div class="col-md-6">
                                    <select name="Empleado" id="Empleado" class="selectpicker form-group" title="Selecciona una opción">
                                        @foreach ($empleados as $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->Nombre }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('Empleado'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Empleado') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-10">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Continuar') }}
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

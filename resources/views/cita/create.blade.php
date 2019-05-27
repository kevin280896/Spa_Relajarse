@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Crear cita') }}</div>

                    <div class="card-body">
                        <center><img src="{{ asset('img/logomail.png') }}" style="width: 30%;"></center>
                        <br><br>
                        <form method="POST" action="{{ route('cita.store') }}" enctype="multipart/form-data">
                            @csrf

                            @if (Auth::user()->Tipo == 'Usuario' || Auth::user()->Tipo == 'Admin')
                                <div class="form-group row">
                                    <label for="Empleado" class="col-md-4 col-form-label text-md-right">{{ __('Masajista') }}</label>

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
                            @else
                                <input type="hidden" id="Empleado" name="Empleado" value="{{ Auth::user()->id }}">
                            @endif

                            @if (Auth::user()->Tipo == 'Empleado' || Auth::user()->Tipo == 'Admin')
                                <div class="form-group row">
                                    <label for="Cliente" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>

                                    <div class="col-md-6">
                                        <select name="Cliente" id="Cliente" class="selectpicker form-group" title="Selecciona una opción">
                                            @foreach ($clientes as $cli)
                                                <option value="{{ $cli->id }}">{{ $cli->name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('Cliente'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('Cliente') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <input type="hidden" id="Cliente" name="Cliente" value="{{ Auth::user()->id }}">
                                <input type="hidden" id="EsCliente" name="EsCliente" value="1">
                            @endif

                            <div class="form-group row">
                                <label for="Servicio" class="col-md-4 col-form-label text-md-right">{{ __('Servicio') }}</label>

                                <div class="col-md-6">
                                    <select name="Servicio" id="Servicio" class="selectpicker form-group" title="Selecciona una opción">
                                        @foreach ($servicios as $serv)
                                            <option value="{{ $serv->id }}">{{ $serv->Nombre }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('Servicio'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Servicio') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>

                                <div class="col-md-6">
                                    <input id="Fecha" type="date" class="form-control{{ $errors->has('Fecha') ? ' is-invalid' : '' }}" name="Fecha" value="{{ old('Fecha') }}" autofocus>

                                    @if ($errors->has('Fecha'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Fecha') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Hora" class="col-md-4 col-form-label text-md-right">{{ __('Hora') }}</label>

                                <div class="col-md-6">
                                    <select name="Hora" id="Hora" class="selectpicker form-group" title="Selecciona una hora">
                                        <option value="10 am">10:00 am</option>
                                        <option value="11 am">11:00 am</option>
                                        <option value="12 pm">12:00 pm</option>
                                        <option value="1 pm">1:00 pm</option>
                                        <option value="2 pm">2:00 pm</option>
                                        <option value="3 pm">3:00 pm</option>
                                        <option value="4 pm">4:00 pm</option>
                                        <option value="5 pm">5:00 pm</option>
                                        <option value="6 pm">7:00 pm</option>
                                    </select>

                                    @if ($errors->has('Hora'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Hora') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-10">
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

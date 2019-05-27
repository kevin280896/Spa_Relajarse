<!DOCTYPE html>
<html>
<head>
    <title>Cita</title>
</head>
<body style="border: #123c24;">
<div class="container">
    <div class="row">
        <center>
            <img src="{{ asset('img/logomail.png') }}" alt="" style="width: 70%">

            <p style="font-size: 22px;"><span style="font-size: 24px; color: #1d643b; font-weight: bold;">Fecha: </span>{{ $cita->Fecha }}</p>
            <p style="font-size: 22px;"><span style="font-size: 24px; color: #1d643b; font-weight: bold;">Hora: </span>{{ $cita->Hora }}</p>
            <p style="font-size: 22px;"><span style="font-size: 24px; color: #1d643b; font-weight: bold;">Paciente: </span>{{ $cita->clientes->name }}</p>
            <p style="font-size: 22px;"><span style="font-size: 24px; color: #1d643b; font-weight: bold;">Empleado: </span>{{ $cita->empleados->Nombre }}</p>
            <p style="font-size: 22px;"><span style="font-size: 24px; color: #1d643b; font-weight: bold;">Servicio: </span>{{ $cita->servicios->Nombre }}</p>
        </center>
    </div>
</div>

</body>
</html>

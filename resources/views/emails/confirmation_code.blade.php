<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>

    <h2 style="color: #000269FF">Hola {{ $name }}, gracias por registrarte!</h2>
    <h3 style="color: #000269FF">Te damos una cordial bienvenida a....</h3>
    <img src="{{ $message->embed('img/logomail.png') }}" style="left: 200px;">
    <p>Para continuar con el proceso, Por favor confirma tu correo electrónico.</p>
    <p>Para ello simplemente debes hacer click en el siguiente enlace:</p>

    <a href="{{ url('/register/verify/' . $confirmation_code) }}">
        Click aqui para confirmar tu email
    </a>
</body>
</html>

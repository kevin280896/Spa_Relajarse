<?php 
$Url = url()->previous() != URL('/') ? url()->previous() : url()->previous().'/';
?>
  <!DOCTYPE html>
  <html>
    <head>
      <!--meta para caracteres especiales-->
      <meta charset="UTF-8">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--estilo css personal-->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/404animation.css') }}">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
    <div class="overlay"></div>
    <div class="terminal">
        <h1>Error <span class="errorcode">404</span></h1>
        <p class="output">
            La página que está buscando podría haber sido eliminada, haber cambiado su nombre o no estar disponible temporalmente
        </p>
        <p class="output">Clic aqui para <a href="{{ $Url }}">Regresar</a></p>
    </div>
      <!--Import jQuery before materialize.js-->
      <!--Script para hacer los datos ordenarse-->
    </body>
  </html>

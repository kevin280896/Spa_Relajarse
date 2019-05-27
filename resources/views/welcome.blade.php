@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col col-sm-3">
                <div class="card" style="background: transparent; border: none;">
                    <img src="{{ asset('img/logo.png') }}" style="width: 350px;">
                </div>
            </div>
            <div class="col-md-9">
                <div class="card" style="width: 95%; position: relative; float: right;">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('img/carousel1.jpg') }}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block" style="background-color: #0b2e13; background-clip:padding-box; border-radius: 45px;">
                                    <h5>Instalaciones</h5>
                                    <p>Contamos con aparatología y equipos de última tecnología, modernos
                                        y eficientes para brindarte los mejores resultados en cada uno de nuestros tratamientos.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img/carousel2.jpg') }}" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block" style="background-color: #0b2e13; background-clip:padding-box; border-radius: 45px;">
                                    <h5>Masajes</h5>
                                    <p>Ademas tenemos amplia variedad de camas para que tenga la mejor experiencia en masajes.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img/carousel3.jpg') }}" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block" style="background-color: #0b2e13; background-clip:padding-box; border-radius: 45px;">
                                    <h5>Aromaterapia</h5>
                                    <p>En todo el spa contamos con aromaterapia, para que tu estadia aqui sea de lo mas placentera.</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

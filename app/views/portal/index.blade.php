@extends('portal.layouts')

@section('contenido')
    <section id="main-slider" class="no-margin">
        <div id="mycar" class="carousel slide auto" data-interval="5000">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
            <?php
                $active = "active";
                ?>
            @foreach(Noticia::all() as $noticia)
                
                <div class="item {{$active}}" style="background-image: url(portal1/images/slider/pizarra.png); background-size: 1300px 730px;">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-12">
                                <div class="carousel-content">

                                    <h1 class="animation animated-item-1">{{$noticia->titulo}}</h1>
                                    <h2 class="animation animated-item-2">{{$noticia->descripcion}}</h2>
                                    @if($noticia->archivo1)
                                    <img src="archivos/noticia/{{$noticia->archivo1}}" width="200">
                                    @endif

                                    @if($noticia->archivo2)
                                    <img src="archivos/noticia/{{$noticia->archivo2}}" width="200">
                                    @endif

                                    @if($noticia->archivo3)
                                    <img src="archivos/noticia/{{$noticia->archivo3}}" width="200">
                                    @endif

                                    @if($noticia->archivo4)
                                    <img src="archivos/noticia/{{$noticia->archivo4}}" width="200">
                                    @endif
                                    <a class="btn-slide animation animated-item-3" href="#">Read More</a>
                                </div>
                            </div>

                            

                        </div>
                    </div>
                </div><!--/.item-->
                <?php
                $active = "";
                ?>
                @endforeach

               

            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </section><!--/#main-slider-->

<script type="text/javascript">



    jQuery(function($) {

         $( "#homeactive" ).addClass( "active" );
    
        $('#mycar').carousel({
            interval: 3000,
            
        });
  

});
</script>
@stop
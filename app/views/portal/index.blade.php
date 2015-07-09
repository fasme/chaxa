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
                                                                        
                <div class="item {{$active}}" style="background-image: url('portal1/images/slider/pizarra.png'); background-size: 1300px 730px;">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-12">
                                <div class="carousel-content">

                                    <h1 class="animation animated-item-1">{{$noticia->titulo}}</h1>
                                    <h2 class="animation animated-item-2">{{$noticia->descripcion}}</h2>
                                    <h2 class="animation animated-item-3">Archivos Adjuntos</h2>
                                    @if($noticia->archivo1)
                                    <!--<img src="archivos/noticia/{{$noticia->archivo1}}" width="200">-->
                                    {{link_to_asset('archivos/noticia/'.$noticia->archivo1, "Descargar $noticia->archivo1", array("class"=>"label label-warning arrowed"))}}
                                    
                                    <a data-toggle="modal" class="botoncito" data-urlarchivo="https://docs.google.com/viewer?url=http://chaxapreventivo.cl/public/archivos/noticia/{{$noticia->archivo1}}&embedded=true"  href="#" >
                                  <span class="label label-success arrowed">Vista Previa</span>
                                </a>
                                    <br>
                                    @endif

                                    @if($noticia->archivo2)
                                   {{link_to_asset('archivos/noticia/'.$noticia->archivo2, "Descargar $noticia->archivo2", array("class"=>"label label-warning arrowed"))}}
                                   

                                   <a data-toggle="modal" class="botoncito" data-urlarchivo="https://docs.google.com/viewer?url=http://chaxapreventivo.cl/public/archivos/noticia/{{$noticia->archivo2}}&embedded=true"  href="#" >
                                  <span class="label label-success arrowed">Vista Previa</span>
                                </a>
                                 <br>
                                    @endif

                                    @if($noticia->archivo3)
                                    {{link_to_asset('archivos/noticia/'.$noticia->archivo3, "Descargar $noticia->archivo3", array("class"=>"label label-warning arrowed"))}}
                                    
                                    <a data-toggle="modal" class="botoncito" data-urlarchivo="https://docs.google.com/viewer?url=http://chaxapreventivo.cl/public/archivos/noticia/{{$noticia->archivo3}}&embedded=true"  href="#" >
                                  <span class="label label-success arrowed">Vista Previa</span>
                                </a>
                                    <br>
                                    @endif

                                    @if($noticia->archivo4)
                                  {{link_to_asset('archivos/noticia/'.$noticia->archivo4, "Descargar $noticia->archivo4", array("class"=>"label label-warning arrowed"))}}
                                  
                                  <a data-toggle="modal" class="botoncito" data-urlarchivo="https://docs.google.com/viewer?url=http://chaxapreventivo.cl/public/archivos/noticia/{{$noticia->archivo4}}&embedded=true"  href="#" >
                                  <span class="label label-success arrowed">Vista Previa</span>
                                </a>
                                  <br>
                                    @endif
                                   <!-- <a class="btn-slide animation animated-item-3" href="#">Read More</a> -->
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







     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Vista Previa</h4>
      </div>
      <div class="modal-body">

      
     
      
     <iframe id="iframe" src="" width="550" height="300" style="border: none;"></iframe> </div>
      
      <div class="modal-footer">
    
        
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">



    jQuery(function($) {

         $( "#homeactive" ).addClass( "active" );
    
        $('#mycar').carousel({
            interval: 3000,
            
        });



        $(".botoncito").click(function(){

  var urlarchivo = $(this).data('urlarchivo');
  

  $("#urlarchivo").val(urlarchivo);


        $('#iframe').attr('src', urlarchivo);
        //$('#iframe').reload();

  $('#myModal').modal("show");
});
  

});
</script>
@stop
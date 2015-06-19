@extends('portal.layouts')

@section('contenido')

<body class="homepage">
<section id="services" class="service-item">
       <div class="container">
            <div class="center wow fadeInDown">
                <h2>Mis Actividades Programadas</h2>
             </div>

            <div class="row">
            @if (Auth::check())

<?php
//$actividadProgramadas = ActividadProgramada::all();
$personal = Personal::find(Auth::user()->id)
?>



 <table id="example" class="table table-striped table-bordered table-hover">

                        <thead>
                          <tr>
                            
                            <th>Elemento Estrategico</th>
                            <th>Cumplimiento Normativo</th>
                            <th class="hidden-480">Actividad</th>
                             <th>Estado</th>
                            <th>Plazo</th>

                            <th>
                              <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                              Subir Evidencia
                            </th>
                            

                           
                          </tr>
                        </thead>

                        <tbody>

                        
                         @foreach($personal->actividadesProgramadas()->where("tipoactividad","=","programada")->get() as $actividad)
                          <tr>
                        
                           <?php
                            $datetime1 = new DateTime($actividad->frecuencia);
                            $datetime2 = new DateTime(date("Y/m/d"));
                            $interval = $datetime1->diff($datetime2);
                            if($interval->format("%R") == "+")
                            {
                              $dif = "<font color='red'>(". $interval->format('%R%a')." Dias)</font>";
                            }
                            else
                            {
                              $dif = "<font color='green'>(". $interval->format('%R%a')." Dias)</font>";
                            }
                             
                            ?>

                            <td>{{ $actividad->elementoestrategico}}</td>
                            <td>{{$actividad->cumplimientonormativo}}</td>
                            <td>{{$actividad->actividad}}</td>
                            <td>{{$actividad->pivot->estado}}</td>
                            <td>{{date_format(date_create($actividad->frecuencia),"d/m/Y")}} {{$dif}}</td>
                            <td>
                             @if($actividad->pivot->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito" data-id="{{$actividad->pivot->id}}" data-actividadid="{{$actividad->pivot->actividad_id}}" data-tipoactividad="{{$actividad->pivot->tipoactividad}}" href="#" >
                                  <i class="ace-icon fa fa-upload bigger-130"></i>
                                </a>
                              </div>
                              @else
                              <a href="evidencia/{{ $actividad->pivot->adjunto1}}">{{$actividad->pivot->adjunto1}}</a><br>
                           <a href="evidencia/{{ $actividad->pivot->adjunto2}}">{{$actividad->pivot->adjunto2}}</a><br>
                           <a href="evidencia/{{ $actividad->pivot->adjunto3}}">{{$actividad->pivot->adjunto3}}</a><br>
                           <a href="evidencia/{{ $actividad->pivot->adjunto4}}">{{$actividad->pivot->adjunto4}}</a><br>
                           <a href="evidencia/{{ $actividad->pivot->adjunto5}}">{{$actividad->pivot->adjunto5}}</a><br>

                              @endif
                              </td>
                            </tr>

                            @endforeach
                            
                            </tbody>
                            </table>






@endif
                
                                                   
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->

    


<section id="services" class="service-item">
       <div class="container">
            <div class="center wow fadeInDown">
                <h2>Mis Actividades No Programadas</h2>
             </div>

            <div class="row">
            @if (Auth::check())

<?php
//$actividadProgramadas = ActividadProgramada::all();
$personal = Personal::find(Auth::user()->id)
?>



 <table id="example1" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            
                            <th class="hidden-480">Actividad</th>
                             <th>Estado</th>
                            <th>Plazo</th>

                            <th>
                              <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                              Subir Evidencia
                            </th>
                            

                           
                          </tr>
                        </thead>

                        <tbody>
                        
                         @foreach($personal->actividadesNoProgramadas()->where("tipoactividad","=","noprogramada")->get() as $actividad)
                          <tr>
                             <?php
                            $datetime1 = new DateTime($actividad->frecuencia);
                            $datetime2 = new DateTime(date("Y/m/d"));
                            $interval = $datetime1->diff($datetime2);
                            if($interval->format("%R") == "+")
                            {
                              $dif = "<font color='red'>(". $interval->format('%R%a')." Dias)</font>";
                            }
                            else
                            {
                              $dif = "<font color='green'>(". $interval->format('%R%a')." Dias)</font>";
                            }
                              
                            ?>
                            <td>{{$actividad->actividad}}</td>
                            <td>{{$actividad->pivot->estado}}</td>
                            <td>{{date_format(date_create($actividad->frecuencia),"d/mY")}} {{$dif}}</td>
                            <td>
                            @if($actividad->pivot->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito" data-id="{{$actividad->pivot->id}}" data-actividadid="{{$actividad->pivot->actividad_id}}" data-tipoactividad="{{$actividad->pivot->tipoactividad}}" href="#" >
                                  <i class="ace-icon fa fa-upload bigger-130"></i>
                                </a>
                              </div>
                              @else

                              <a href="evidencia/{{ $actividad->pivot->adjunto1}}">{{$actividad->pivot->adjunto1}}</a><br>
                           <a href="evidencia/{{ $actividad->pivot->adjunto2}}">{{$actividad->pivot->adjunto2}}</a><br>
                           <a href="evidencia/{{ $actividad->pivot->adjunto3}}">{{$actividad->pivot->adjunto3}}</a><br>
                           <a href="evidencia/{{ $actividad->pivot->adjunto4}}">{{$actividad->pivot->adjunto4}}</a><br>
                           <a href="evidencia/{{ $actividad->pivot->adjunto5}}">{{$actividad->pivot->adjunto5}}</a><br>

                              @endif
                              </td>
                            </tr>
                            @endforeach
                            
                            </tbody>
                            </table>






@endif
                
                                                   
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->



<section id="services" class="service-item">
       <div class="container">
            <div class="center wow fadeInDown">
                <h2>Mis Actividades Provenientes del PAC</h2>
             </div>

            <div class="row">
            @if (Auth::check())

<?php
//$actividadProgramadas = ActividadProgramada::all();
$personal = Personal::find(Auth::user()->id)
?>

<!--

 <table id="example2" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            
                           
                            <th class="hidden-480">Actividad</th>
                            <th>Estado</th>
                            <th>Plazo</th>

                            <th>
                              <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                              Accion
                            </th>
                            

                           
                          </tr>
                        </thead>

                        <tbody>
                        
                         @foreach($personal->actividadesNoProgramadas()->where("tipoactividad","=","pac")->get() as $actividad)
                          <tr>
                            
                            <td>{{$actividad->actividad}}</td>
                            <td>{{$actividad->estado}}</td>
                            <td>{{date_format(date_create($actividad->frecuencia),"d/mY")}}</td>
                            <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="botoncito" data-id="{{$actividad->id}}">
                                  <i class="ace-icon fa fa-archive bigger-130"></i>
                                </a>

                               
                              </div>
                              </td>
                            </tr>
                            @endforeach
                            
                            </tbody>
                            </table>

-->




@endif
                
                                                   
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->





<!-- Modal -->
{{Form::open(array('url' => 'evidenciaupdate', 'files' => true))}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Enviar Evidencia</h4>
      </div>
      <div class="modal-body">
      {{Form::hidden("actividadid","",array("id"=>"actividadid"))}}
      {{Form::hidden("id","",array("id"=>"id"))}}
      {{Form::hidden("tipoactividad","",array("id"=>"tipoactividad"))}}
      
      
      {{Form::label("Archivo 1")}}
      {{Form::file("adjunto1")}}

      {{Form::label("Archivo 2")}}
      {{Form::file("adjunto2")}}

      {{Form::label("Archivo 3")}}
      {{Form::file("adjunto3")}}

      {{Form::label("Archivo 4")}}
      {{Form::file("adjunto4")}}

      {{Form::label("Archivo 5")}}
      {{Form::file("adjunto5")}}
      </div>
      <div class="modal-footer">
    
        {{Form::submit("Enviar", array("class"=>"btn btn-primary"))}}
      </div>
    </div>
  </div>
</div>
{{Form::close()}}

</body>

    

  

    








    <script type="text/javascript">


 $(document).ready(function() {


  $( "#actividadactive" ).addClass( "active" );

var oTable1 = 
        $('#example')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "js/spanish.datatables.json"
            }
        });



var oTable1 = 
        $('#example1')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "js/spanish.datatables.json"
            }
        });


        var oTable1 = 
        $('#example2')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "js/spanish.datatables.json"
            }
        });


$(".botoncito").click(function(){

  var id = $(this).data('id');
  var actividadid = $(this).data('actividadid');
  var tipoactividad = $(this).data('tipoactividad');

  $("#actividadid").val(actividadid);
  $("#id").val(id);
  $("#tipoactividad").val(tipoactividad);
  //alert(id);
  $('#myModal').modal("show");
});


});
 </script>

@stop
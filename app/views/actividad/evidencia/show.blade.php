@extends('layouts.master')

@section('contenido')















<?php
$actividadresponsable = DB::table('actividad_responsable_noprogramada')->Where("personal_admin_id","=",Auth::user()->id)->get();
//$actividadresponsable_kpi =  Kpi::all(); //DB::table('actividad_responsable_kpi')->Where("personal_admin_id","=",Auth::user()->id)->get();
$actividadresponsable_programada = DB::table('actividad_responsable_programada')->Where("personal_admin_id","=",Auth::user()->id)->get();

//$actividadresponsable_pac = DB::table('actividad_responsable_pac')->Where("personal_admin_id","=",Auth::user()->id)->get();
$actividadresponsable_mantencion = DB::table('actividad_responsable_mantencion')->Where("personal_id","=",Auth::user()->id)->get();


?>

<div class="row">


 <h3 class="header smaller lighter">Todas las actividades: 
                
    </h3>


 <table id="example" class="table table-striped table-bordered table-hover">

                        <thead>
                          <tr>
                            
                            <th>Actividad</th>
                            <th>Personal</th>
                        <th>Tipo</th>
                             <th>Estado</th>
                            <th>Plazo</th>

                            <th>
                              <i class="ace-icon fa fa-clock-o bigger-110 hidden-480 red"></i>
                              Accion
                            </th>
                            

                           
                          </tr>
                        </thead>

                         <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                  <th>Position</th>
                    <th></th>
                      <th></th>
               
            </tr>
        </tfoot>


                        <tbody>

                        
                        
                             @foreach($actividadresponsable as $actividad)

                              <?php
                           $busqueda = "";
                            ?>

                          
                            <?php
                             $busqueda = ActividadNoProgramada::find($actividad->actividad_id);
                            ?>

                         
                            
                          <tr>
                            
                        
                           <?php
                            $datetime1 = new DateTime($busqueda->frecuencia);
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

                             if($actividad->estado == "Cerrada")
                            {
                              $dif = "";
                            }
                             
                            ?>

                            <td>{{ $busqueda->actividad}}</td>
                            <td>{{Personal::find($actividad->personal_id)->nombre}}</td>
                          <td>{{$actividad->tipoactividad}}</td>
                            <td>{{$actividad->estado}}</td>
                            <td>{{date_format(date_create($busqueda->frecuencia),"d/m/Y")}} {{$dif}}</td>
                            <td>
                            @if($actividad->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito" data-id="{{$actividad->id}}" data-actividadid="{{$actividad->actividad_id}}" data-tipoactividad="{{$actividad->tipoactividad}}" href="#" >
                                  <i class="ace-icon fa fa-times bigger-130 red"></i>
                                </a>
                              </div>
                              @else
                              <a href="archivos/evidencia/{{ $actividad->adjunto1}}">{{$actividad->adjunto1}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto2}}">{{$actividad->adjunto2}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto3}}">{{$actividad->adjunto3}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto4}}">{{$actividad->adjunto4}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto5}}">{{$actividad->adjunto5}}</a><br>
                           
                                     @if($actividad->estado != "Cerrada")
                                      <a href='#' data-id="{{$actividad->id}}" data-tipoactividad="{{$actividad->tipoactividad}}"  class="bootbox-confirm"><button class="btn btn-success">Cerrar actividad</button></a>
                                    @endif
                              @endif
                              </td>
                            </tr>
                                @endforeach








                                 @foreach(Kpi::all() as $actividad)
                                  @foreach($actividad->muchaspersonal()->get() as $actividad2)
                        
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

                             if($actividad->estado == "Cerrada")
                            {
                              $dif = "";
                            }
                             
                            ?>

                            <td>{{ $actividad2->pivot->actividad}}</td>
                            <td>{{Personal::find($actividad2->pivot->personal_id)->nombre}}</td>
                            <td>{{"KPI"}}</td>
                            <td>{{$actividad2->pivot->estado}}</td>
                            

                          
                            <td>{{date_format(date_create($actividad2->pivot->frecuencia),"d/m/Y")}} {{$dif}}</td>
                            <td>
                            <a class="blue bootbox-mostrar" data-id="{{$actividad->id}}" data-tipoactividad="kpi">
                            <i class="fa fa-search-plus bigger-130"></i>
                          </a>
                            @if($actividad2->pivot->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito"  href="#" >
                                  <i class="ace-icon fa fa-times bigger-130 red"></i>
                                </a>
                              </div>
                              @else
                              <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto1}}">{{$actividad2->pivot->adjunto1}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto2}}">{{$actividad2->pivot->adjunto2}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto3}}">{{$actividad2->pivot->adjunto3}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto4}}">{{$actividad2->pivot->adjunto4}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto5}}">{{$actividad2->pivot->adjunto5}}</a><br>
                           
                                     @if($actividad2->pivot->estado != "Cerrada")
                                      <a href='#' data-id="{{$actividad2->pivot->id}}"  data-tipoactividad="kpi" data-actividadid="{{$actividad2->pivot->kpi_id}}" data-personalid="{{$actividad2->pivot->personal_id}}" class="bootbox-confirm"><button class="btn btn-success">Cerrar actividad</button></a>
                                    @endif
                              @endif
                              </td>
                            </tr>
                                @endforeach
                                  @endforeach









                                 @foreach($actividadresponsable_programada as $actividad)

                              <?php
                           $busqueda = "";
                            ?>

                            <?php 
                            $busqueda = ActividadProgramada::find($actividad->actividad_id);
                            ?>
                           

                         
                            
                          <tr>
                            
                        
                           <?php
                            $datetime1 = new DateTime($busqueda->frecuencia);
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


                             if($actividad->estado == "Cerrada")
                            {
                              $dif = "";
                            }
                             
                            ?>

                            <td>{{ $busqueda->actividad}}</td>
                            <td>{{Personal::find($actividad->personal_id)->nombre}}</td>
                          <td>{{$actividad->tipoactividad}}</td>
                            <td>{{$actividad->estado}}</td>
                            <td>{{date_format(date_create($actividad->frecuencia),"d/m/Y")}} {{$dif}}</td>
                            <td>
                            <a class="blue bootbox-mostrar" data-id="{{$busqueda->id}}" data-tipoactividad="programada">
                            <i class="fa fa-search-plus bigger-130"></i>
                          </a>
                            @if($actividad->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito" data-id="{{$actividad->id}}" data-actividadid="{{$actividad->actividad_id}}" data-tipoactividad="{{$actividad->tipoactividad}}" href="#" >
                                  <i class="ace-icon fa fa-times bigger-130 red"></i>
                                </a>
                              </div>
                              @else
                              <a href="archivos/evidencia/{{ $actividad->adjunto1}}">{{$actividad->adjunto1}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto2}}">{{$actividad->adjunto2}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto3}}">{{$actividad->adjunto3}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto4}}">{{$actividad->adjunto4}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto5}}">{{$actividad->adjunto5}}</a><br>
                           
                                     @if($actividad->estado != "Cerrada")
                                      <a href='#' data-id="{{$actividad->id}}" data-tipoactividad="{{$actividad->tipoactividad}}" class="bootbox-confirm"><button class="btn btn-success">Cerrar actividad</button></a>
                                    @endif
                              @endif
                              </td>
                            </tr>
                                @endforeach









                                 @foreach(Pac::all() as $actividad)
                                  @foreach($actividad->muchaspersonal()->get() as $actividad2)
                        
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

                             if($actividad->estado == "Cerrada")
                            {
                              $dif = "";
                            }
                             
                            ?>

                            <td>{{ $actividad2->pivot->actividad}}</td>
                            <td>{{Personal::find($actividad2->pivot->personal_id)->nombre}}</td>
                            <td>{{"Pac"}}</td>
                            <td>{{$actividad2->pivot->estado}}</td>
                            

                          
                            <td>{{date_format(date_create($actividad2->pivot->frecuencia),"d/m/Y")}} {{$dif}}</td>
                            <td>
                            <a class="blue bootbox-mostrar" data-id="{{$actividad->id}}" data-tipoactividad="pac">
                            <i class="fa fa-search-plus bigger-130"></i>
                          </a>
                            @if($actividad2->pivot->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito"  href="#" >
                                  <i class="ace-icon fa fa-times bigger-130 red"></i>
                                </a>
                              </div>
                              @else
                              <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto1}}">{{$actividad2->pivot->adjunto1}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto2}}">{{$actividad2->pivot->adjunto2}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto3}}">{{$actividad2->pivot->adjunto3}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto4}}">{{$actividad2->pivot->adjunto4}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad2->pivot->adjunto5}}">{{$actividad2->pivot->adjunto5}}</a><br>
                           
                                     @if($actividad2->pivot->estado != "Cerrada")
                                      <a href='#' data-id="{{$actividad2->pivot->id}}"  data-tipoactividad="pac" data-actividadid="{{$actividad2->pivot->pac_id}}" data-personalid="{{$actividad2->pivot->personal_id}}" class="bootbox-confirm"><button class="btn btn-success">Cerrar actividad</button></a>
                                    @endif
                              @endif
                              </td>
                            </tr>
                                @endforeach
                                  @endforeach









                                @foreach($actividadresponsable_mantencion as $actividad)
                          <tr>
                        
                           <?php
                           
                            
                             
                            $busqueda = "";
                            ?>

                            
                            <?php 
                            $busqueda = Mantencion::find($actividad->actividad_id);
                            ?>
                            



                            <?php

                            $datetime1 = new DateTime($busqueda->frecuencia);
                            $datetime2 = new DateTime(date("Y/m/d"));
                            $interval = $datetime1->diff($datetime2);
                            if($interval->format("%R") == "+")
                            {
                              $dif = "<font color='red'>(". $interval->format('Atrasado %a')." Dias)</font>";
                            }
                            else
                            {
                              $dif = "<font color='green'>(". $interval->format('Faltan %a')." Dias)</font>";
                            }

                            if($actividad->estado == "Cerrada")
                            {
                              $dif = "";
                            }

                            ?>
                            <td>{{$busqueda->mantencionrealizada}}</td>
                            
                            
                            
                            <td>{{Personal::find($actividad->personal_id)->nombre}}</td>
                            <td>{{$actividad->tipoactividad}}</td>
                            <td>{{$actividad->estado}}</td>
                            <td>{{date_format(date_create($busqueda->frecuencia),"d/m/Y")}} {{$dif}}</td>
                            
                            <td>
                            @if($actividad->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito" data-id="{{$actividad->id}}" data-tipoactividad="{{$actividad->tipoactividad}}" data-actividadid="{{$actividad->actividad_id}}" data-tipoactividad="{{$actividad->tipoactividad}}" href="#" >
                                  <i class="ace-icon fa fa-upload bigger-130"></i>
                                </a>
                              </div>
                              @else

                              <a href="archivos/evidencia/{{ $actividad->adjunto1}}">{{$actividad->adjunto1}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto2}}">{{$actividad->adjunto2}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto3}}">{{$actividad->adjunto3}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto4}}">{{$actividad->adjunto4}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->adjunto5}}">{{$actividad->adjunto5}}</a><br>
                                @if($actividad->estado != "Cerrada")
                                      <a href='#' data-id="{{$actividad->id}}" data-tipoactividad="{{$actividad->tipoactividad}}" class="bootbox-confirm"><button class="btn btn-success">Cerrar actividad</button></a>
                                    @endif
                                    
                              @endif
                              </td>
                           
                            </tr>

                            @endforeach
                           
                            
                            </tbody>



                           


                            </table>







                
                                                   
            </div><!--/.row-->
    







    

  

    








    <script type="text/javascript">


 $(document).ready(function() {


$( "#evidenciaactive" ).addClass( "active" );

/*
$('#example tfoot th').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
*/
$('#example tfoot th').eq(0).html( '<input type="text" placeholder="Buscar " style="width:50px" />' );
$('#example tfoot th').eq(1).html( '<input type="text" placeholder="Buscar " style="width:50px" />' );
$('#example tfoot th').eq(2).html( '<input type="text" placeholder="Buscar " style="width:50px" />' );


var table = $('#example').DataTable();

table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );


var oTable2 = 
        $('#example1')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "js/spanish.datatables.json"
            }
        });






$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
  var tipoactividad = $(this).data("tipoactividad");
  var actividadid = $(this).data("actividadid");
  var personalid  = $(this).data("personalid");
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas cerrar la actividad "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('evidenciaadmin/cerraractividad')}}",
              { id: id, tipoactividad: tipoactividad, actividadid: actividadid, personalid:personalid },

              function(data,status){ alert(data);}
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });








$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');
  var tipoactividad = $(this).data("tipoactividad");

 $.get("{{ url('evidenciaadmin/mostrar')}}",
              { id: id, tipoactividad:tipoactividad },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
          });




});
 </script>

@stop
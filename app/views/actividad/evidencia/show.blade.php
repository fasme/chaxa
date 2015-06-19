@extends('layouts.master')

@section('contenido')


<div class="row">


 <h3 class="header smaller lighter">Evidencia (Actividad Programada): 
                
    </h3>


 <table id="example" class="table table-striped table-bordered table-hover">

                        <thead>
                          <tr>
                            
                            <th>Actividad</th>
                            <th>Personal</th>
                        
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

                        
                         @foreach($personals as $personal)
                             @foreach($personal->actividadesProgramadas()->Where("personal_admin_id","=",Auth::user()->id)->get() as $actividad)

                         
                            
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

                            <td>{{ $actividad->actividad}}</td>
                            <td>{{$personal->nombre}}</td>
                          
                            <td>{{$actividad->pivot->estado}}</td>
                            <td>{{date_format(date_create($actividad->frecuencia),"d/m/Y")}} {{$dif}}</td>
                            <td>
                            @if($actividad->pivot->estado == "Abierta")
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a data-toggle="modal" class="botoncito" data-id="{{$actividad->pivot->id}}" data-actividadid="{{$actividad->pivot->actividad_id}}" data-tipoactividad="{{$actividad->pivot->tipoactividad}}" href="#" >
                                  <i class="ace-icon fa fa-times bigger-130 red"></i>
                                </a>
                              </div>
                              @else
                              <a href="archivos/evidencia/{{ $actividad->pivot->adjunto1}}">{{$actividad->pivot->adjunto1}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->pivot->adjunto2}}">{{$actividad->pivot->adjunto2}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->pivot->adjunto3}}">{{$actividad->pivot->adjunto3}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->pivot->adjunto4}}">{{$actividad->pivot->adjunto4}}</a><br>
                           <a href="archivos/evidencia/{{ $actividad->pivot->adjunto5}}">{{$actividad->pivot->adjunto5}}</a><br>
                           
                                     @if($actividad->pivot->estado != "Cerrada")
                                      <a href='#' data-id="{{$actividad->pivot->id}}" class="bootbox-confirm"><button class="btn btn-success">Cerrar actividad</button></a>
                                    @endif
                              @endif
                              </td>
                            </tr>
                                @endforeach
                            @endforeach
                            
                            </tbody>



                           


                            </table>







                
                                                   
            </div><!--/.row-->


    







    

  

    








    <script type="text/javascript">


 $(document).ready(function() {


 $( "#actividadactive" ).addClass( "active" );
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


        var oTable3 = 
        $('#example2')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "js/spanish.datatables.json"
            }
        });





$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas cerrar la actividad "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('evidenciaadmin/cerraractividad')}}",
              { id: id },

              function(data,status){ alert(data);}
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });




});
 </script>

@stop
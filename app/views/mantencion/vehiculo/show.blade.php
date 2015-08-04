@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

                    <h3 class="header smaller lighter">Vehiculos: 
                    <a href="{{URL::to('vehiculo/insert')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>Agregar</a>
    </h3>



                    <div class="clearfix">
                      <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                      Resultados
                    </div>
        
 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Familia</th>
            <th>Tipo</th>
            <th>N Interno</th>
            <th>Patente</th>
            <th>Horometro</th>
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($vehiculos as $vehiculo)
           <tr>

             <td> {{ $vehiculo->familia}}</td>
             <td> {{ $vehiculo->tipo}}</td>
             <td> {{ $vehiculo->ninterno}}</td>
             <td> {{ $vehiculo->patente}}</td>
             <td>{{$vehiculo->horometro}}</td>
         

  <td class="td-actions">
                       
                      
                          <a class="blue bootbox-mostrar" data-id={{$vehiculo->id}}>
                            <i class="fa fa-search-plus bigger-130"></i>
                          </a>


                          <a class="green" href= {{ 'vehiculo/update/'.$vehiculo->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-id={{ $vehiculo->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>

                          <a class="blue" href={{'mantencion/insert/'.$vehiculo->id}}>
                            <span class="label label-white middle">Asignar Mantención</span>
                          </a>

                      </td>
</tr>
          @endforeach
        </tbody>
  </table>

  </div>




<div class="col-xs-12">

                    <h3 class="header smaller lighter">Ultima mantencion: 
                   
    </h3>



                    <div class="clearfix">
                      <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                      Resultados
                    </div>
        
 
<table id="example2" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Vehiculo</th>
            <th>Mantencion Realizada</th>
            <th>Proxima Mantencion</th>
            <th>Fecha Mantencion</th>
           <!-- <th>Horometro Mantencion</th> -->
            <th>Horometro Proxima Mantencion</th>
            <th>Horometro Actual</th>
            <th>Horas Restantes Proximo Mantenimiento</th>
            <th>Estado</th>
           
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>

<?php
$mantencion = "";
?>

  @foreach($vehiculos as $vehiculo)

    
       <?php
       $mantencion = $vehiculo->mantencion()->orderby("id","desc")->first();

      
      ?>

@if(count($mantencion) >0) 
<?php 
           
           


             if($mantencion->horometromantencion != 0)
             {
              $diferencia = $mantencion->proximahorometro - $mantencion->horometromantencion; 
              $estado = "Enviada";
             }
             else
             {
              $diferencia = $mantencion->proximahorometro - $mantencion->vehiculo->horometro; 
              $estado = "Pendiente";
             }

           

           ?> 
<tr>
          <td> {{ $mantencion->vehiculo->familia." / ". $mantencion->vehiculo->patente}}</td> 
          <td>{{ $mantencion->mantencionrealizada}} Horas</td> 
          <td>{{$mantencion->proximamantencion}} Horas</td> 
          <td>{{date_format(date_create($mantencion->fecha_mantencion),'d/m/Y')}} 
          <!--<td>{{$mantencion->horometromantencion}}</td>--> 
          <td>{{$mantencion->proximahorometro}}</td>
          <td>{{$vehiculo->horometro}}</td> 
          <td> 
          @if($diferencia>0) 
          <div class="green">faltan: {{$diferencia}}</div> 
          @else 
          <div class="red">atrasado: {{$diferencia}}</div> 
          @endif 
          </td>
          <td>{{$estado}}</td>

  <td class="td-actions"> 
                       
                      
                          <a class="blue bootbox-mostrar" data-id={{$mantencion->id}}> 
                            <i class="fa fa-search-plus bigger-130"></i> 
                          </a> 


                        <!--  <a class="green" href= {{ 'mantencion/update/'.$mantencion->id }}> 
                            <i class="fa fa-pencil bigger-130"></i> 
                          </a> -->

                         <a class="red bootbox-confirm2" data-id={{ $mantencion->id }}> 
                            <i class="fa fa-trash bigger-130"></i> 
                          </a> 


                          <a class="blue" href={{'mantencion/insert/'.$mantencion->vehiculo->id}}>
                            <span class="label label-white middle">Asignar Mantención</span>
                          </a>

                      </td>

@endforeach
</tr>
@endif

  
          
        </tbody>
  </table>

  </div>


  <script type="text/javascript">
 $(document).ready(function() {


$('#example').DataTable( {
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );


$('#example2').DataTable( {
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );


$( "#mantencionactive" ).addClass( "active" );
$( "#vehiculoactive" ).addClass( "active" );




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('vehiculo/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });




$(".bootbox-confirm2").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('mantencion/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });



$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');

 $.get("{{ url('vehiculo/mostrar')}}",
              { id: id },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop


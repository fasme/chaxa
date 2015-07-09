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
                            <span class="label label-white middle">Generar Mantención</span>
                          </a>

                      </td>
</tr>
          @endforeach
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


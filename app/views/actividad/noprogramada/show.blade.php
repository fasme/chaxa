@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

                    <h3 class="header smaller lighter">Actividad No Programada: 
                    <a href="{{URL::to('actividadnoprogramada/insert')}}"  class="btn btn-white btn-info btn-bold"> 
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
            <th>Actividad</th>
            <th>Fecha</th>
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($actividadnoprogramadas as $actividadnoprogramada)
           <tr>

             <td> {{ $actividadnoprogramada->actividad}}</td>
             <td>{{date_format(date_create($actividadnoprogramada->frecuencia),'d/m/Y')}}</td>
         

  <td class="td-actions">
                       
                      
                          <a class="blue bootbox-mostrar" data-id={{$actividadnoprogramada->id}}>
                            <i class="fa fa-search-plus bigger-130"></i>
                          </a>


                          <a class="green" href= {{ 'actividadnoprogramada/update/'.$actividadnoprogramada->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-id={{ $actividadnoprogramada->id }}>
                            <i class="fa fa-trash bigger-130"></i>
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


$( "#actividadactive" ).addClass( "active" );
$( "#noprogramadaactive" ).addClass( "active" );




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('actividadnoprogramada/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });


$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');

 $.get("{{ url('actividadnoprogramada/mostrar')}}",
              { id: id },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop


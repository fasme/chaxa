@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

                    <h3 class="header smaller lighter">Transacción: 
                    <a href="{{URL::to('productotransaccion/insert')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>Agregar</a>
    </h3>



                    <div class="clearfix">
                      <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                      Resultados
                    </div>
        
 
<table id="example" class="table table-striped table-bordered table-hover">
<div class="info"></div>
  <thead>
          <tr>
          <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Tipo</th>
                           
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($productotransaccions as $productotransaccion)
           <tr>
           <td>{{ $productotransaccion->producto->nombre}}</td>
                            
                            <td>{{$productotransaccion->cantidad}}</td>
                            <td>@if ($productotransaccion->tipo == 1) 
                            Entrada
                            @elseif ($productotransaccion->tipo == 2)
                            Salida
                            @endif</td>
                            
         

  <td class="td-actions">
                       
                      
                        <!--  <a class="blue bootbox-mostrar" data-id={{$productotransaccion->id}}>
                            <i class="fa fa-search-plus bigger-130"></i>
                          </a>


                          <a class="green" href= {{ 'productotransaccion/update/'.$productotransaccion->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-id={{ $productotransaccion->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>-->
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>

  </div>


  <script type="text/javascript">
 $(document).ready(function() {


var table = $('#example').DataTable( {
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );


var tableTools = new $.fn.dataTable.TableTools( table, {
  

    
      "aButtons": [
                    
                   
                    {
                        "sExtends": "pdf",
                        "sButtonText":"Listado pdf",
                        //"sTitle": "Report Name",
                        //"sPdfMessage": "Summary Info",
                        "sFileName": "<?php print('Informe'); ?>.pdf",
                        "sPdfOrientation": "landscape",
                        "oSelectorOpts": {page: 'current'},

                    }

                ]
      
    } );


$( tableTools.fnContainer() ).insertAfter('div.info');

$( "#bodegaactive" ).addClass( "active" );
$( "#productotransaccionactive" ).addClass( "active" );




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('productotransaccion/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });


$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');

 $.get("{{ url('productotransaccion/mostrar')}}",
              { id: id },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop


@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

                    <h3 class="header smaller lighter">Producto: 
                    <a href="{{URL::to('producto/insert')}}"  class="btn btn-white btn-info btn-bold"> 
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
                            <th>Stock</th>
                            <th>Tipo</th>
                           
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($productos as $producto)
           <tr>
           <td>{{ $producto->nombre}}</td>
                            
                            <td>{{$producto->productotransaccion->sum('cantidad')}}</td>
                            <td>@if ($producto->tipoproducto == 1) 
                            Insumo
                            @elseif ($producto->tipoproducto == 2)
                            Herramienta
                            @endif</td>
                            
         

  <td class="td-actions">
                       
                      
                          <a class="blue bootbox-mostrar" data-id={{$producto->id}}>
                            <i class="fa fa-search-plus bigger-130"></i>
                          </a>


                          <a class="green" href= {{ 'producto/update/'.$producto->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-id={{ $producto->id }}>
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
$( "#productoactive" ).addClass( "active" );




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('producto/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });


$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');

 $.get("{{ url('producto/mostrar')}}",
              { id: id },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop


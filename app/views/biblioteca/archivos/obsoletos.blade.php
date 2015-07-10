@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

                    <h3 class="header smaller lighter">Archivos Obsoletos: 
                 <!--   <a href="{{URL::to('archivo/insert')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>Agregar</a> -->
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
          <th>Nombre Documento</th>
                            <th>Categoria</th>
                            <th>Codigo</th>
                            <th>Version</th>
                            <th>Tiempo Vigencia</th>
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($archivos as $archivo)
           <tr>
         <td>{{ $archivo->nombre}}</td>
                            <td>{{$archivo->categoria->nombre}}</td>
                            <td>{{$archivo->codigo}}</td>
                            <td>{{$archivo->version}}</td>
                            <td>{{$archivo->tiempo}}</td>
         
         

  <td class="td-actions">
                       
            {{
link_to_asset('archivos/biblioteca/'.$archivo->archivo, "Descargar", array("class"=>"label label-warning arrowed"))
}}      
                       

                          <a class="green" href= {{ 'archivo/update/'.$archivo->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-id={{ $archivo->id }}>
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

$( "#bibliotecaactive" ).addClass( "active" );
$( "#obsoletoactive" ).addClass( "active" );




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('archivo/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });


$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');

 $.get("{{ url('archivo/mostrar')}}",
              { id: id },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop


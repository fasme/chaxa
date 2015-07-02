@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">
{{Form::open(array("url"=>"matriz/pdf/filtro"))}}
                 
 <h3 class="header smaller lighter">
                    <a href="{{URL::to('matriz/insert')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>Agregar</a>

    <a href="{{URL::to('matriz/pdf')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-file-pdf-o bigger-120 red"></i>Matriz Completa</a>

    
   <input type="submit" class="btn btn-white btn-info btn-bold" value="Matriz Filtrada">
   <select id="selectmatrices" name="selectmatrices[]" multiple="multiple" style="visibility:hidden">
  
  
   </select>
   </h3>
{{Form::close()}}


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
            <th>Proceso</th>
            <th>Actividad</th>
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($matrizs as $matriz)
           <tr  id="{{$matriz->id}}">

             <td> {{ $matriz->proceso}}</td>
             <td>
             @foreach($matriz->muchasactividad as $actividad)
                            {{$actividad->nombre." / "}}
                            @endforeach
                            </td>
         

  <td class="td-actions">
                       
                      
                          <a class="blue bootbox-mostrar" data-id={{$matriz->id}}>
                            <i class="fa fa-search-plus bigger-130"></i>
                          </a>


                          <a class="green" href= {{ 'matriz/update/'.$matriz->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-id={{ $matriz->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>


                          <a class="blue" href= {{ 'matriz/pdf/'.$matriz->id }}>
                            <i class="fa fa-file-pdf-o bigger-130"></i>
                          </a>
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>

  </div>







<div class="row">
  <div class="col-xs-6">

   <h3 class="header smaller lighter">Cambios: 
                    <a href="{{URL::to('cambio/insert')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>Agregar</a>
    </h3>


      <table id="example1" class="table table-striped table-bordered table-hover">

  <thead>
          <tr>
            <th>Version</th>
            <th>Descripcion</th>
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($cambios as $cambio)
           <tr  id="{{$matriz->id}}">

             <td> {{ $cambio->version}}</td>
             <td>
             
                            {{$cambio->descripcion}}
                           
                            </td>
         

  <td class="td-actions">
                       
                      
                     


                          <a class="green" href= {{ 'cambio/update/'.$cambio->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-id={{ $cambio->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>


                         
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>
  </div>
</div>


<!-- CARGO -->


  <script type="text/javascript">
 $(document).ready(function() {


var table1 = $('#example1').DataTable( {
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );


var table = $('#example').DataTable( {
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );


var tableTools = new $.fn.dataTable.TableTools( table, {
  'sRowSelect': "multi",
  "fnRowSelected": function(nodes) {
      var a = nodes[0].id;
      $("#selectmatrices").append("<option value="+a+" selected>"+a+"</option>");
      /*
        if (myDeselectList) {
            var nodeList = myDeselectList;
            myDeselectList = null;
            this.fnDeselect(nodeList);
        }
        */
    },
    "fnRowDeselected": function(nodes){
      var a = nodes[0].id;
      $("#selectmatrices option[value="+a+"]").remove();

    },
      "aButtons": [
                    {
                        "sExtends": "copy",
                        //"sTitle": "Report Name",
                        //"sPdfMessage": "Summary Info",
                       // "sFileName": "<?php print('Actividad No Programada'); ?>.pdf",
                        //"sPdfOrientation": "landscape",
                        "oSelectorOpts": {page: 'current'},

                    },
                   
                    {
                        "sExtends": "pdf",
                        //"sTitle": "Report Name",
                        //"sPdfMessage": "Summary Info",
                        "sFileName": "<?php print('Informe'); ?>.pdf",
                        "sPdfOrientation": "landscape",
                        "oSelectorOpts": {page: 'current'},

                    },
                    "print"
                ]
    
      
    } );
$( tableTools.fnContainer() ).insertAfter('div.info');


$( "#matrizactive" ).addClass( "active" );
$( "#matrizmatrizactive" ).addClass( "active" );



$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('matriz/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });


$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');

 $.get("{{ url('matriz/mostrar')}}",
              { id: id },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop


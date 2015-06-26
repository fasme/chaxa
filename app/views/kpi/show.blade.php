@extends('layouts.master')
 



@section('contenido')





<div class="col-xs-12">

                    <h3 class="header smaller lighter">KPI: 
                    <a href="{{URL::to('kpi/insert')}}"  class="btn btn-white btn-info btn-bold"> 
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
          <th>Objetivo</th>
            <th>Meta</th>
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($kpis as $kpi)
           <tr>
           <td>{{$kpi->kpiobjetivo->nombre}}</td>
             <td> {{ $kpi->meta}}</td>
          
         

  <td class="td-actions">
                       
                      
                          <a class="blue bootbox-mostrar" data-id={{$kpi->id}}>
                            <i class="fa fa-search-plus bigger-130"></i>
                          </a>


                          <a class="green" href= {{ 'kpi/update/'.$kpi->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-id={{ $kpi->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>

  </div>



  <!-- OBJETIVO -->

<div class="col-xs-6">

                    <h3 class="header smaller lighter">Objetivo: 
                    <a href="{{URL::to('kpiobjetivo/insert')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>Agregar</a>
    </h3>



                    <div class="clearfix">
                      <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                      Resultados
                    </div>
        
 
<table id="example1" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Nombre</th>
          
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($kpiobjetivos as $kpiobjetivo)
           <tr>

             <td> {{ $kpiobjetivo->nombre}}</td>
         

  <td class="td-actions">
                       
                      


                          <a class="green" href= {{ 'kpiobjetivo/update/'.$kpiobjetivo->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirmcargo" data-id={{ $kpiobjetivo->id }}>
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


var table = $('#example1').DataTable( {
      
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );


var tableTools = new $.fn.dataTable.TableTools( table, {
  

    
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
                        "sFileName": "<?php print('Actividad Programada'); ?>.pdf",
                        "sPdfOrientation": "landscape",
                        "oSelectorOpts": {page: 'current'},

                    },
                    "print",

                ]
      
    } );


$( tableTools.fnContainer() ).insertAfter('div.info');



$( "#kpiactive" ).addClass( "active" );




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('kpi/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });


$(".bootbox-confirmcargo").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('kpiobjetivo/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });


$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');

 $.get("{{ url('kpi/mostrar')}}",
              { id: id },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop


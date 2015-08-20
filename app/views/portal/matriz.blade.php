@extends('portal.layouts')

@section('contenido')
<section id="services" class="service-item">
       <div class="container">
            <div class="center wow fadeInDown">
                <h2>Matriz</h2>
             </div>

            <div class="row">
            @if (Auth::check())


{{Form::open(array("url"=>"matriz/pdf/filtro"))}}
                 

          
    <a href="{{URL::to('matriz/pdf')}}"  class="btn btn-white btn-info btn-bold"> 
    <i class="ace-icon fa fa-file-pdf-o bigger-120 red"></i>Generar Matriz Completa</a>

    
   <input type="submit" class="btn btn-white btn-info btn-bold" value="Generar Matriz Filtrada">
   <select id="selectmatrices" name="selectmatrices[]" multiple="multiple" style="visibility:hidden" >
  
  
   </select>
   
{{Form::close()}}


 <table id="example" class="table table-striped table-bordered table-hover">
<div class="info"></div>
                        <thead>
                          <tr>
                            
                            <th class="hidden-480">Proceso</th>
                            
                            <th>Peligro</th>
                            <th>Actividad</th>
                            <th>Acciones</th>
                            


                           
                          </tr>
                        </thead>

                        <tbody>
                        
                         @foreach(Matriz::all() as $matriz)
                          <tr id="{{$matriz->id}}">
                            
                            <td>{{$matriz->proceso}}</td>
                            <td>{{$matriz->peligro->nombre}}</td>
                            <td>
                            @foreach($matriz->muchasactividad as $actividad)
                            {{$actividad->nombre}}
                            @endforeach
                            </td>
                            <td>
                            <a href= {{ 'matriz/pdf/'.$matriz->id }}>
                            <span class="label label-success arrowed">Descargar</span>

                          </a></td>
                           
                            
                            </tr>
                            @endforeach
                            
                            </tbody>
                            </table>






@endif
                
                                                   
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->



    <script type="text/javascript">


 $(document).ready(function() {


  $( "#matrizactive" ).addClass( "active" );

var table = 
        $('#example')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            "language": {
                "url": "datatables.spanish.json"
            }
        });


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
                    
                   /*
                    {
                        "sExtends": "pdf",
                        //"sTitle": "Report Name",
                        //"sPdfMessage": "Summary Info",
                        "sFileName": "<?php print('Informe'); ?>.pdf",
                        "sPdfOrientation": "landscape",
                        "oSelectorOpts": {page: 'current'},

                    }
                    */
                ]
    
      
    } );
$( tableTools.fnContainer() ).insertAfter('div.info');




$(".botoncito").click(function(){

  var id = $(this).data('id');
  var actividadid = $(this).data('actividadid');
  var tipoactividad = $(this).data('tipoactividad');

  $("#actividadid").val(actividadid);
  $("#id").val(id);
  $("#tipoactividad").val(tipoactividad);
  //alert(id);
  $('#myModal').modal("show");
});


});
 </script>


@stop
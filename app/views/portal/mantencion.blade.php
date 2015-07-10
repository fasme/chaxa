@extends('portal.layouts')

@section('contenido')

<body class="homepage">
<section id="services" class="service-item">
       <div class="container">
            <div class="center wow fadeInDown">
                <h2>Vehiculos</h2>
             </div>

            <div class="row">
            @if (Auth::check())

<?php
//$actividadProgramadas = ActividadProgramada::all();
$vehiculos = Vehiculo::all();
?>



 <table id="example" class="table table-striped table-bordered table-hover">
<div class="info"></div>
                        <thead>
                          <tr>
                            
                          <tr>
            <th>Familia</th>
            <th>Tipo</th>
            <th>N Interno</th>
            <th>Patente</th>
            <th>Horometro Actual</th>
          
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
                            
                            <td>
                            <!-- <a data-toggle="modal" class="botoncito" data-id="{{$vehiculo->id}}"  href="#" >
                                  <span class="label label-success arrowed">Generar Mantencion</span>
                                </a>
                                -->

                                <a data-toggle="modal" class="botoncito2" data-id="{{$vehiculo->id}}"  href="#" >
                                  <span class="label label-warning arrowed">Ingresar Horometro</span>
                                </a>

                               
                                </td>
                          
                            </tr>

                            @endforeach
                            
                            </tbody>
                            </table>






@endif
                
                                                   
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->

    















<section id="services" class="service-item">
       <div class="container">
            <div class="center wow fadeInDown">
                <h2>Ultima Mantencion</h2>
             </div>

            <div class="row">
            @if (Auth::check())

<?php
//$actividadProgramadas = ActividadProgramada::all();
$vehiculos = Vehiculo::all();
?>



 <table id="example2" class="table table-striped table-bordered table-hover">
<div class="info2"></div>
                        <thead>
                          <tr>
                            
                          <tr>
           <th>Vehiculo</th>
            <th>Mantencion Realizada</th>
            <th>Proxima Mantencion</th>
            <th>Fecha Mantencion</th>
            <th>Horometro Mantencion</th>
            <th>Horometro Proxima Mantencion</th>
            <th>Horometro Actual</th>
            <th>Horas Restantes Proximo Mantenimiento</th>
            <th>Acciones</th>
          
 
            
          </tr>
        </thead>
        <tbody>


  @foreach(Vehiculo::has("mantencion")->get() as $vehiculo)
<?php
  $mantencion = $vehiculo->mantencion()->orderby("id","desc")->first();
  $diferencia = $mantencion->proximahorometro - $mantencion->vehiculo->horometro; 
           
  ?>
           <tr>

            <td> {{ $mantencion->vehiculo->familia." / ". $mantencion->vehiculo->patente}}</td> 
            <td>{{ $mantencion->mantencionrealizada}}</td> 
            <td>{{$mantencion->proximamantencion}}</td> 
            <td>{{date_format(date_create($mantencion->fecha_mantencion),'d/m/Y')}} 
          <td>{{$mantencion->horometromantencion}}</td> 
          <td>{{$mantencion->proximahorometro}}</td>
          <td>{{$vehiculo->horometro}}</td> 
          <td> 
          @if($diferencia>0) 
          <div class="btn btn-success">{{$diferencia}}</div> 
          @else 
          <div class="btn btn-danger">{{$diferencia}}</div> 
          @endif 
          </td>

          <td>
          @if($mantencion->horometromantencion==0)
          <a data-toggle="modal" class="botoncito" data-id="{{$mantencion->id}}"  href="#" >
                                  <span class="label label-success arrowed">Generar Mantencion</span>
                                </a>
                                @else
                                Enviada
                                @endif

                                </td>
                            
                            
                          
                            </tr>

                            @endforeach
                            
                            </tbody>
                            </table>






@endif
                
                                                   
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->




</body>

    



    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mantencion</h4>
      </div>
      <div class="modal-body">


      <div class="modal-footer">
    
        
      </div>
    </div>
  </div>
</div>
</div>

  

    








    <script type="text/javascript">


 $(document).ready(function() {


  $( "#mantencionactive" ).addClass( "active" );


var table = $('#example').DataTable( {
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );




var tableTools = new $.fn.dataTable.TableTools( table, {
  
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
                        "sExtends": "pdf",
                        "sButtonText":"Listado",
                        "sTitle": "LISTADO",
                        "sPdfMessage": "Summary Info",
                        "sFileName": "<?php print('Informe'); ?>.pdf",
                        "sPdfOrientation": "landscape",
                        "oSelectorOpts": {page: 'current'},

                    }
                ]
    
      
    } );

$( tableTools.fnContainer() ).insertAfter('div.info');





var table2 = $('#example2').DataTable( {
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );



var tableTools = new $.fn.dataTable.TableTools( table2, {
  
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
                        "sExtends": "pdf",
                        "sButtonText":"Listado",
                        "sTitle": "LISTADO",
                        "sPdfMessage": "",
                        "sFileName": "<?php print('Informe'); ?>.pdf",
                        "sPdfOrientation": "landscape",
                        "oSelectorOpts": {page: 'current'},

                    }
                ]
    
      
    } );
$( tableTools.fnContainer() ).insertAfter('div.info2');







/*
        var tableTools2 = new $.fn.dataTable.TableTools( table2, {
  
  "fnRowSelected": function(nodes) {
      var a = nodes[0].id;
      $("#selectmatrices").append("<option value="+a+" selected>"+a+"</option>");
      
    },
    "fnRowDeselected": function(nodes){
      var a = nodes[0].id;
      $("#selectmatrices option[value="+a+"]").remove();

    },
      "aButtons": [
                    {
                        "sExtends": "pdf",
                        "sButtonText":"Listado",
                        "sTitle": "Report Name",
                        "sPdfMessage": "Summary Info",
                        "sFileName": "<?php print('Informe'); ?>.pdf",
                        "sPdfOrientation": "landscape",
                        "oSelectorOpts": {page: 'current'},

                    }
                ]
    
      
    } );
$( tableTools2.fnContainer() ).insertAfter('div.info2');

*/




$(".botoncito").click(function(){

  var id = $(this).data('id');
  

   $.get("{{ url('mantencionportal/mostrar')}}",
              { id: id },
              function(data)
              { 
               
                //bootbox.dialog({message: data});
                $(".modal-body").html(data);
                $('#myModal').modal("show");

              });
});





$(".botoncito2").click(function(){

  var id = $(this).data('id');
  

   $.get("{{ url('vehiculoportal/update')}}",
              { id: id },
              function(data)
              { 
               
                //bootbox.dialog({message: data});
                $(".modal-body").html(data);
                $('#myModal').modal("show");

              });
});



});
 </script>

@stop
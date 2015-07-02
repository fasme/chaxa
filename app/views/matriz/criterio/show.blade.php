@extends('layouts.master')
 



@section('contenido')




<div class="row">
<div class="col-xs-12">

                    <h3 class="header smaller lighter">Exposicion: 
                    <a href="{{URL::to('criterioexposicion/insert')}}"  class="btn btn-white btn-info btn-bold"> 
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
            <th>Nombre</th>
          <th>Descripcion</th>
          <th>Factor</th>
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($criterioexposicions as $criterioexposicion)
           <tr>

             <td> {{ $criterioexposicion->nombre}}</td>
             <td>{{$criterioexposicion->descripcion}}</td>
             <td>{{$criterioexposicion->factor}}</td>
         

  <td class="td-actions">
                       
                      
                   

                          <a class="green" href= {{ 'criterioexposicion/update/'.$criterioexposicion->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-table="criterioexposicion" data-id={{ $criterioexposicion->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>

  </div>





<!-- CONSECUENCIA -->


<div class="col-xs-12">

                    <h3 class="header smaller lighter">Consecuencia: 
                    <a href="{{URL::to('criterioconsecuencia/insert')}}"  class="btn btn-white btn-info btn-bold"> 
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
            <th>Nombre</th>
          <th>Descripcion</th>
          <th>Factor</th>
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($criterioconsecuencias as $criterioconsecuencia)
           <tr>

             <td> {{ $criterioconsecuencia->nombre}}</td>
             <td>{{$criterioconsecuencia->descripcion}}</td>
             <td>{{$criterioconsecuencia->factor}}</td>
         

  <td class="td-actions">
                       
                      
                      

                          <a class="green" href= {{ 'criterioconsecuencia/update/'.$criterioconsecuencia->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-table="criterioconsecuencia" data-id={{ $criterioconsecuencia->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>

  </div>




<!-- Probabilidad -->

<div class="col-xs-12">

                    <h3 class="header smaller lighter">Probabilidad: 
                    <a href="{{URL::to('criterioprobabilidad/insert')}}"  class="btn btn-white btn-info btn-bold"> 
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
            <th>Nombre</th>
          <th>Descripcion</th>
          <th>Factor</th>
  <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>


  @foreach($criterioprobabilidads as $criterioprobabilidad)
           <tr>

             <td> {{ $criterioprobabilidad->nombre}}</td>
             <td>{{$criterioprobabilidad->descripcion}}</td>
             <td>{{$criterioprobabilidad->factor}}</td>
         

  <td class="td-actions">
                       
                      
                 

                          <a class="green" href= {{ 'criterioprobabilidad/update/'.$criterioprobabilidad->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-table="criterioprobabilidad" data-id={{ $criterioprobabilidad->id }}>
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


$('#example').DataTable( {
      
       "language": {
                "url": "datatables.spanish.json"
            }
    } );




$( "#matrizactive" ).addClass( "active" );
$( "#criterioexposicionactive" ).addClass( "active" );




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
  var table = $(this).data("table");
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             if(table == "exposicion")
             {
              alert("exposicion");
             }
             if(table == "probabilidad")
             {
              alert("probabilidad");
             }
             if(table == "consecuencia")
             {
              alert("consecuencia");
             }

             $.get(table+"/eliminar",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });


$(".bootbox-mostrar").on(ace.click_event, function() {
  var id = $(this).data('id');

 $.get("{{ url('criterioexposicion/mostrar')}}",
              { id: id },
              function(data)
              { 
                bootbox.dialog({message: data});

              });
          
             
         


     
            
           
          });
     





}); // fin ready
 </script>




        

        


@stop


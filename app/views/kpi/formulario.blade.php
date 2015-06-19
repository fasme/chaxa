@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Kpi
              <small>
                <i class="icon-double-angle-right"></i>
                
              </small>
            </h1>
          </div><!--/.page-header-->


     @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif


<div class="row">
  <div class="col-xs-12">

           <?php
  // si existe el usuario carga los datos
    if ($kpi->exists):
        $form_data = array('url' => 'kpi/update/'.$kpi->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'kpi/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       
  



             <div class="form-group">
            {{Form::label('', 'Meta',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('meta', $kpi->meta)}}
            </div>



          
<div class="row">
  <div class="col-xs-12">
 

 

            <a id="agregarCampo" class="btn btn-info" href="#">Agregar Objetivo</a>
        <div id="contenedor">
           

        

</div>
  </div>
</div>




           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   



$( "#kpiactive" ).addClass( "active" );


$(".chosen-select").chosen();






var MaxInputs       = 8; //Número Maximo de Campos
    var contenedor       = $("#contenedor"); //ID del contenedor
    var AddButton       = $("#agregarCampo"); //ID del Botón Agregar

    //var x = número de campos existentes en el contenedor
    var x = $("#contenedor div").length + 1;
    var FieldCount = x-1; //para el seguimiento de los campos

    $(AddButton).click(function (e) {
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++;
            //agregar campo

            $(contenedor).after('<div>{{Form::select("selectpac[]",$personals)}}{{Form::text("actividad[]","",array("placeholder"=>"Actividad"))}}{{Form::text("plazo[]", "", array("id"=>"plazo", "class"=>"date-picker",  "data-date-format"=>"dd/mm/yyyy"))}}<a href="#" class="eliminar">&times;</a></div>');
            x++; //text box increment
           

            $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        });

            //$("#plazo").addClass("date-picker");

        }
        return false;
    });

    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });





    
  });   
</script>

@stop



@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Actividad No Programada
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
    if ($actividadnoprogramada->exists):
        $form_data = array('url' => 'actividadnoprogramada/update/'.$actividadnoprogramada->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'actividadnoprogramada/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       

             <div class="form-group">
            {{Form::label('', 'Actividad',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::textarea('actividad', $actividadnoprogramada->actividad)}}
            </div>


            <?php
                              $array = ActividadNoProgramada::find($actividadnoprogramada->id);
                              $arrayName = "";
                              if(count($array) >0)
                              {

                              foreach ($array->muchaspersonal as $key) {
                               echo $arrayName[] = $key->id;
                               
                              }
                            }

                              ?>

                         <!--     <div class="form-group">
                              {{Form::label('', 'Personal',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('personal_id[]', $personals, $arrayName, array("class"=>"chosen-select", "multiple"=>"multiple"))}}
                              </div>


         <div class="form-group">
            {{Form::label('', 'Plazo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('frecuencia', date_format(date_create($actividadnoprogramada->frecuencia),'d/m/Y'), array("class"=>"date-picker", "id"=>"id-date-picker-1", "data-date-format"=>"dd/mm/yyyy"))}}
            </div>-->


                      <div class="row">
  <div class="col-xs-12">



 @foreach($actividadnoprogramada->muchaspersonal as $actividad)

  <div>{{Form::select('personal_id[]', $personals, $actividad->pivot->personal_id, array("class"=>"chosen-select"))}}
{{Form::text("frecuencia[]", date_format(date_create($actividad->pivot->frecuencia), 'd/m/Y'), array("id"=>"plazo", "class"=>"date-picker",  "data-date-format"=>"dd/mm/yyyy"))}}<a href="#" class="eliminar">&times;</a></div>

  @endforeach
            <a id="agregarCampo" class="btn btn-info" href="#">Agregar Plazo</a>
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
   



$( "#actividadactive" ).addClass( "active" );
$( "#noprogramadaactive" ).addClass( "active" );


$(".chosen-select").chosen();

$('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });








var MaxInputs       = 100; //Número Maximo de Campos
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

            $(contenedor).after('<div>{{Form::select('personal_id[]', $personals, "", array("class"=>"chosen-select"))}}{{Form::text("frecuencia[]", "", array("id"=>"plazo", "class"=>"date-picker",  "data-date-format"=>"dd/mm/yyyy"))}}<a href="#" class="eliminar">&times;</a></div>');
            x++; //text box increment
           

            $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        });

            //$("#plazo").addClass("date-picker");
            $(".chosen-select").chosen();

        }
        return false;
    });

    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
     //   if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
       //     x--;
        //}
        return false;
    });




    
  });   
</script>

@stop



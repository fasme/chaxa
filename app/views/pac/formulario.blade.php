@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Plan de Accion
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
    if ($pac->exists):
        $form_data = array('url' => 'pac/update/'.$pac->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'pac/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       
  

   <div class="form-group">
            {{Form::label('', 'Quien Ingresa Reporte',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('personal_id', $personal, $pac->personal_id)}}
            </div>



             <div class="form-group">
            {{Form::label('', 'Faena',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('faena', $pac->faena)}}
            </div>

            <div class="row">
            <div class="col-xs-4">
                <div class="form-group">
                {{Form::label('', 'OHSAS 18001',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('ohsas','1', $pac->ohsas)}}
                </div>
            </div>
            <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'ISO 9001',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('iso9','1', $pac->iso9)}}
                </div>
            </div>
             <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'ISO 14001',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('iso1','1', $pac->iso1)}}
                </div>
            </div>
            </div>



<div class="row">
             <div class="col-xs-4">
                <div class="form-group">
                {{Form::label('', 'Aud. Interna',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('audinterna','1', $pac->audinterna)}}
                </div>
            </div>
            <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'Aud. Externa',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('audexterna','1', $pac->audexterna)}}
                </div>
            </div>
             <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'Rev. Gerencial ',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('revgerencial','1', $pac->revgerencial)}}
                </div>
            </div>
</div>



<div class="row">
             <div class="col-xs-4">
                <div class="form-group">
                {{Form::label('', 'Recl. Cliente',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('reccliente','1', $pac->reccliente)}}
                </div>
            </div>
            <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'Inspecciones',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('inspecciones','1', $pac->inspecciones)}}
                </div>
            </div>
             <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'Legal',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('legal','1', $pac->legal)}}
                </div>
            </div>
</div>


<div class="row">
             <div class="col-xs-4">
                <div class="form-group">
                {{Form::label('', 'NC',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('nc', '1', $pac->nc)}}
                </div>
            </div>
            <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'OBS',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('obs', '1',$pac->obs)}}
                </div>
            </div>
             <div class="col-xs-4">
                 <div class="form-group">
                {{Form::label('', 'OM',array("class"=>"col-sm-4 control-label no-padding-right"))}}
                {{Form::checkbox('om', '1', $pac->om)}}
                </div>
            </div>
</div>


<div class="row">
<div class="col-xs-12">
    <div class="form-group">
    {{Form::label('', 'Causa',array("class"=>"col-sm-3 control-label no-padding-right"))}}
    {{Form::textarea('identificacion', $pac->identificacion,['size' => '60x2'])}}
    </div>

    <div class="form-group">
    {{Form::label('', '1.- Por que ?',array("class"=>"col-sm-3 control-label no-padding-right"))}}
    {{Form::textarea('porque1', $pac->porque1,['size' => '60x2'])}}
    </div>

    <div class="form-group">
    {{Form::label('', '2.- Por que ?',array("class"=>"col-sm-3 control-label no-padding-right"))}}
    {{Form::textarea('porque2', $pac->porque2,['size' => '60x2'])}}
    </div>

    <div class="form-group">
    {{Form::label('', '3.- Por que ?',array("class"=>"col-sm-3 control-label no-padding-right"))}}
    {{Form::textarea('porque3', $pac->porque3,['size' => '60x2'])}}
    </div>

    <div class="form-group">
    {{Form::label('', '4.- Por que ?',array("class"=>"col-sm-3 control-label no-padding-right"))}}
    {{Form::textarea('porque4', $pac->porque4,['size' => '60x2'])}}
    </div>

    <div class="form-group">
    {{Form::label('', '5.- Por que ? (Causa Raiz)',array("class"=>"col-sm-3 control-label no-padding-right"))}}
    {{Form::textarea('porque5', $pac->porque5,['size' => '60x2'])}}
    </div>
</div>
</div>

<div class="row">
  <div class="col-xs-12">
  @foreach($pac->muchaspersonal as $actividadpac)

  <div>{{Form::select("selectpac[]",$personals,$actividadpac->pivot->personal_id)}}{{Form::text("actividad[]", $actividadpac->pivot->actividad)}}{{Form::text("frecuencia[]", date_format(date_create($actividadpac->pivot->plazo), 'd/m/Y'), array("id"=>"plazo", "class"=>"date-picker",  "data-date-format"=>"dd/mm/yyyy"))}}{{Form::select("tipoplan[]",array("1"=>"Plan de accion inmediato","2"=>"Plan de accion Correctivo","3"=>"Plan de accion preventivo"), $actividadpac->pivot->tipoplan)}}<a href="#" class="eliminar">&times;</a></div>

  @endforeach
            <a id="agregarCampo" class="btn btn-info" href="#">Agregar Solucion</a>
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
   



$( "#pacactive" ).addClass( "active" );


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

            $(contenedor).after('<div>{{Form::select("selectpac[]",$personals)}}{{Form::text("actividad[]","",array("placeholder"=>"Actividad"))}}{{Form::text("frecuencia[]", "", array("id"=>"plazo", "class"=>"date-picker",  "data-date-format"=>"dd/mm/yyyy"))}}{{Form::select("tipoplan[]",array("1"=>"Plan de accion inmediato","2"=>"Plan de accion Correctivo","3"=>"Plan de accion preventivo"))}}<a href="#" class="eliminar">&times;</a></div>');
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
        //if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
          //  x--;
        //}
        return false;
    });



    
  });   
</script>

@stop



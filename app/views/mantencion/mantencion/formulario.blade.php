@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Mantencion
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
    if ($mantencion->exists):
        $form_data = array('url' => 'mantencion/update/'.$mantencion->id, 'files'=>true);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'mantencion/insert', 'class'=>'class="form-horizontal', 'files'=>true);
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}



{{ Form::hidden("vehiculo_id", $vehiculo->id)}}


       
            <div class="form-group">
            {{Form::label('', 'Vehiculo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{$vehiculo->familia." / ".$vehiculo->patente}}
            </div>

<?php
$mantencionideal = $vehiculo->mantencion()->orderby("id","desc")->first();

if($mantencionideal)
{
  $mantencionideal = $mantencionideal->proximahorometro;
}
else
{
  $mantencionideal=0;
}
?>
  <div class="form-group">
            {{Form::label('', 'Horometro mantencion ideal:',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{number_format($mantencionideal,0,",",".")}}
            </div>


            <?php
                              $array = Mantencion::find($mantencion->id);
                              $arrayName = "";
                              if(count($array) >0)
                              {

                              foreach ($array->muchaspersonal as $key) {
                               echo $arrayName[] = $key->id;
                               
                              }
                            }

                              ?>

            <div class="form-group">
                              {{Form::label('', 'Personal',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('personal_id[]', $personals, $arrayName, array("class"=>"chosen-select", "multiple"=>"multiple"))}}
                              </div>

            <div class="form-group">
            {{Form::label('', 'Horometro Actual',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{number_format($vehiculo->horometro,0,",",".")}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Mantención a realizar',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('mantencionrealizada', array(0=>"Seleccione",250=>"250",500=>"500",750=>"750",1000=>"1000",1250=>"1250",1500=>"1500",1750=>"1750",2000=>"2000"), $mantencion->mantencionrealizada,  array("id"=>"mantencionrealizada", "class"=>"calculos"))}}
            </div>

          <div class="form-group">
            {{Form::label('', 'Próxima Mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('proximamantencion', $mantencion->proximamantencion, array("id"=>"proximamantencion","readonly"=>"readonly", "class"=>"calculos"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Fecha de Mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('fecha_mantencion', date_format(date_create($mantencion->fecha_mantencion),'d/m/Y'), array("class"=>"date-picker","data-date-format"=>"dd/mm/yyyy"))}}
            </div>

<!--
            <div class="form-group">
            {{Form::label('', 'Hormetro de Mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('horometromantencion', $vehiculo->horometro, array("id"=>"horometromantencion", "class"=>"calculos"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Horometro proxima mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('proximahorometro', $mantencion->proximahorometro, array("id"=>"proximahorometro", "class"=>"calculos", "readonly"=>"readonly"))}}
            </div>
            
-->       
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   


$( "#mantencionactive" ).addClass( "active" );

$('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        });
       

$(".chosen-select").chosen();



$(".calculos").change(function(){
 
  var mantencionrealizada = $("#mantencionrealizada").val();

  if(mantencionrealizada >= 2000)
  {
    mantencionrealizada = 0;
   // $("#mantencionrealizada").val(mantencionrealizada);
  }

  var suma1 = parseFloat(mantencionrealizada) + 250;
  $("#proximamantencion").val(suma1);



  var horometromantencion = $("#horometromantencion").val();
  var suma1 = parseFloat(horometromantencion) + 250;

  $("#proximahorometro").val(suma1);
  //alert(horometroactual);
});
    
  });   
</script>

@stop



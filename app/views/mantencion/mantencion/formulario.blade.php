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


  <div class="form-group">
            {{Form::label('', 'Horometro mantencion ideal:',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{number_format($vehiculo->mantencion()->orderby("id","desc")->first()->proximahorometro,0,",",".")}}
            </div>


            <div class="form-group">
            {{Form::label('', 'Horometro Actual',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{number_format($vehiculo->horometro,0,",",".")}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Mantención a realizar',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('mantencionrealizada', $mantencion->mantencionrealizada,  array("id"=>"mantencionrealizada", "class"=>"calculos"))}}
            </div>

          <div class="form-group">
            {{Form::label('', 'Próxima Mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('proximamantencion', $mantencion->proximamantencion, array("id"=>"proximamantencion","readonly"=>"readonly", "class"=>"calculos"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Fecha de Mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('fecha_mantencion', date_format(date_create($mantencion->fecha_mantencion),'d/m/Y'), array("class"=>"date-picker"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Hormetro de Mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('horometromantencion', $mantencion->horometromantencion, array("id"=>"horometromantencion", "class"=>"calculos"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Horometro proxima mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('proximahorometro', $mantencion->proximahorometro, array("id"=>"proximahorometro", "class"=>"calculos"))}}
            </div>
            
       
        
     

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
       



$(".calculos").keyup(function(){
 
  var mantencionrealizada = $("#mantencionrealizada").val();

  if(mantencionrealizada >= 2000)
  {
    mantencionrealizada = 250;
    $("#mantencionrealizada").val(mantencionrealizada);
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



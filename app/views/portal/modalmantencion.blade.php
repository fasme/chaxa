
<?php $vehiculo = Vehiculo::find($id) ?>


      <?php
  // si existe el usuario carga los datos
    if ($mantencion->exists):
        $form_data = array('url' => 'mantencionportal/update/'.$mantencion->id, 'files'=>true);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'mantencionportal/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}

<div class="row">
<div class="col-sm-12">
 <div class="form-group">

 {{ Form::hidden("vehiculo_id", $vehiculo->id)}}


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
            {{Form::select('mantencionrealizada', array(250=>"250",500=>"500",750=>"750",1000=>"1000",1250=>"1250",1500=>"1500",1750=>"1750",2000=>"2000"), $mantencion->mantencionrealizada,  array("id"=>"mantencionrealizada", "class"=>"calculos"))}}
            </div>

          <div class="form-group">
            {{Form::label('', 'Próxima Mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('proximamantencion', $mantencion->proximamantencion, array("id"=>"proximamantencion","readonly"=>"readonly", "class"=>"calculos"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Fecha de Mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('fecha_mantencion', date_format(date_create($mantencion->fecha_mantencion),'d/m/Y'), array("class"=>"date-picker", " data-date-format"=>"dd/mm/yyyy"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Hormetro de Mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('horometromantencion', $vehiculo->horometro, array("id"=>"horometromantencion", "class"=>"calculos"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Horometro proxima mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('proximahorometro', $mantencion->proximahorometro, array("id"=>"proximahorometro", "class"=>"calculos", "readonly"=>"readonly"))}}
            </div>


             <div class="form-group">
            {{Form::submit('Enviar')}}
            </div>


</div>
 </div>


 {{Form::close()}}


<script type="text/javascript">
 $(document).ready(function() {


  $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        });
       


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
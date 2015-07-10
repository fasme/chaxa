
<?php 
$mantencion = Mantencion::find($id);
//$vehiculo = Vehiculo::find($id); 
?>


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

 {{ Form::hidden("id", $mantencion->id)}}


            {{Form::label('', 'Vehiculo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{$mantencion->vehiculo->familia." / ".$mantencion->vehiculo->patente}}
            </div>


<?php
/*
$mantencionideal = $vehiculo->mantencion()->orderby("id","desc")->first();

if($mantencionideal)
{
  $mantencionideal = $mantencionideal->proximahorometro;
}
else
{
  $mantencionideal=0;
}
*/
?>

            <div class="form-group">
            {{Form::label('', 'Horometro mantencion ideal:',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{number_format($mantencion->proximahorometro,0,",",".")}}
            </div>


            <div class="form-group">
            {{Form::label('', 'Horometro Actual',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{number_format($mantencion->vehiculo->horometro,0,",",".")}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Mantención a realizar',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{ $mantencion->mantencionrealizada}}
            </div>

           <div class="form-group">
            {{Form::label('', 'Próxima Mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('proximamantencion', $mantencion->proximamantencion, array("id"=>"proximamantencion","readonly"=>"readonly", "class"=>"calculos"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Fecha de Mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('fecha_mantencion', date_format(date_create($mantencion->fecha_mantencion),'d/m/Y'), array("class"=>"date-picker", "data-date-format"=>"dd/mm/yyyy", "readonly"=>"readonly"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Hormetro de Mantención',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('horometromantencion', $mantencion->vehiculo->horometro, array("id"=>"horometromantencion","readonly"=>"readonly"))}}
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
       




 


  var horometromantencion = $("#horometromantencion").val();
  var suma1 = parseFloat(horometromantencion) + 250;


  $("#proximahorometro").val(suma1);
  //alert(horometroactual);


});
 </script>
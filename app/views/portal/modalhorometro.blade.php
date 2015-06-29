<?php
$vehiculo = Vehiculo::find($id);
?>

<div class="row">
  <div class="col-xs-12">

           <?php
  // si existe el usuario carga los datos
    if ($vehiculo->exists):
        $form_data = array('url' => 'vehiculoportal/update/'.$vehiculo->id, 'files'=>true);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'vehiculoportal/insert', 'class'=>'class="form-horizontal', 'files'=>true);
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}


       
            <div class="form-group">
            {{Form::label('', 'Vehiculo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{$vehiculo->familia." / ".$vehiculo->patente}}
            </div>

           <div class="form-group">
            {{Form::label('', 'Horometro',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('horometro', $vehiculo->horometro,  array("id"=>"mantencionrealizada", "class"=>"calculos"))}}
            </div>
       
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->

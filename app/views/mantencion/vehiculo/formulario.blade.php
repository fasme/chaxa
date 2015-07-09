@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Vehiculo
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
    if ($vehiculo->exists):
        $form_data = array('url' => 'vehiculo/update/'.$vehiculo->id, 'files'=>true);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'vehiculo/insert', 'class'=>'class="form-horizontal', 'files'=>true);
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       
            <div class="form-group">
            {{Form::label('Familia', 'Familia',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('familia', $vehiculo->familia)}}
            </div>

            <div class="form-group">
            {{Form::label('Tipo', 'Tipo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('tipo', $vehiculo->tipo)}}
            </div>

            <div class="form-group">
            {{Form::label('Numero Interno', 'Numero Interno',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('ninterno', $vehiculo->ninterno)}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Patente',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('patente', $vehiculo->patente)}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Marca',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('marca', $vehiculo->marca)}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Modelo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('modelo', $vehiculo->modelo)}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Horometro Actual',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('horometro', $vehiculo->horometro)}}
            </div>
       
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$( "#mantencionactive" ).addClass( "active" );
$( "#vehiculoactive" ).addClass( "active" );
    
    
$('.input-mask-date').mask('99/99/9999');
$('.input-mask-date2').mask('99/99/9999');


  });   
</script>

@stop



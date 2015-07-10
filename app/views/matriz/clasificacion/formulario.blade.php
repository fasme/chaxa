@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
            Clasificacion
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
    if ($clasificacion->exists):
        $form_data = array('url' => 'clasificacion/update/'.$clasificacion->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'clasificacion/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       

            

             <div class="form-group">
            {{Form::label('', 'Desde',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('desde', $clasificacion->desde)}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Hasta',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::number('hasta', $clasificacion->hasta)}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Clasificacion',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('clasificacion', $clasificacion->clasificacion)}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Accion',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('accion', $clasificacion->accion)}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Color',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('color', array("green"=>"Verde","yellow"=>"Amarillo","red"=>"Rojo"), $clasificacion->color)}}
            </div>

           



           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$( "#matrizactive" ).addClass( "active" );
$( "#clasificacionactive" ).addClass( "active" );
    
  });   
</script>

@stop



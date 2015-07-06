@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Archivo
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
    if ($archivo->exists):
        $form_data = array('url' => 'archivo/update/'.$archivo->id, 'files'=>true);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'archivo/insert', 'class'=>'class="form-horizontal', 'files'=>true);
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       
            <div class="form-group">
            {{Form::label('Nombre', 'Nombre',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('nombre', $archivo->nombre)}}
            </div>

            <div class="form-group">
            {{Form::label('Categoria', 'Categoria',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('categoria_id', $categoria, $archivo->categoria_id)}}
            </div>

            <div class="form-group">
            {{Form::label('Codigo', 'Codigo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('codigo', $archivo->codigo)}}
            </div>

            <div class="form-group">
            {{Form::label('Version', 'Version',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('version', $archivo->version)}}
            </div>

            <div class="form-group">
            {{Form::label('Tiempo Vigencia', 'Tiempo Vigencia',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('tiempo', $archivo->tiempo)}}
            </div>

         

            <div class="form-group">
            {{Form::label('Archivo', 'Archivo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::file('archivo')}}
            {{$archivo->archivo}}
            </div>
           
           <div class="form-group">
           {{ Form::hidden('obsoleto', '') }}
            {{Form::label('', 'Obsoleto?',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::checkbox('obsoleto', "si", $archivo->obsoleto)}}
            </div>
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$('.input-mask-date').mask('99/99/9999');
$('.input-mask-date2').mask('99/99/9999');


$( "#archivoactive" ).addClass( "active" );
    
  });   
</script>

@stop



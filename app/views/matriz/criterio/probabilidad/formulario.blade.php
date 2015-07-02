@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Probabilidad
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
    if ($criterioprobabilidad->exists):
        $form_data = array('url' => 'criterioprobabilidad/update/'.$criterioprobabilidad->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'criterioprobabilidad/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       

          

             <div class="form-group">
            {{Form::label('', 'Nombre',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('nombre', $criterioprobabilidad->nombre)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Descripcion',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('descripcion', $criterioprobabilidad->descripcion)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Factor',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('factor', $criterioprobabilidad->factor)}}
            </div>



           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   



$( "#criterioprobabilidadactive" ).addClass( "active" );
    
  });   
</script>

@stop



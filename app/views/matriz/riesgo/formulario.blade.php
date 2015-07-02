@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
            Matriz Riesgo
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
    if ($matrizriesgo->exists):
        $form_data = array('url' => 'matrizRiesgo/update/'.$matrizriesgo->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'matrizRiesgo/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       

            

             <div class="form-group">
            {{Form::label('', 'Nombre',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('nombre', $matrizriesgo->nombre)}}
            </div>

           



           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$( "#matrizactive" ).addClass( "active" );
$( "#matrizriesgoactive" ).addClass( "active" );
    
  });   
</script>

@stop



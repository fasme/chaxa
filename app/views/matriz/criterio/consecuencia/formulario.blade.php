@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Consecuencia
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
    if ($criterioconsecuencia->exists):
        $form_data = array('url' => 'criterioconsecuencia/update/'.$criterioconsecuencia->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'criterioconsecuencia/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       

          

             <div class="form-group">
            {{Form::label('', 'Nombre',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('nombre', $criterioconsecuencia->nombre)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Descripcion',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('descripcion', $criterioconsecuencia->descripcion)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Factor',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('factor', $criterioconsecuencia->factor)}}
            </div>



           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   


$( "#criterioconsecuenciaactive" ).addClass( "active" );
    
  });   
</script>

@stop



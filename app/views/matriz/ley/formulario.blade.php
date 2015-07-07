@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
            Requisito Legal
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
    if ($matrizley->exists):
        $form_data = array('url' => 'matrizLey/update/'.$matrizley->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'matrizLey/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       

            

             <div class="form-group">
            {{Form::label('', 'Nombre',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('nombre', $matrizley->nombre)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Articulo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('articulo', $matrizley->articulo)}}
            </div>


            <div class="form-group">
            {{Form::label('', 'Descripcion',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('descripcion', $matrizley->descripcion)}}
            </div>


           



           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$( "#matrizactive" ).addClass( "active" );
$( "#matrizleyactive" ).addClass( "active" );
    
  });   
</script>

@stop



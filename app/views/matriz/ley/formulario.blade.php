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
        $form_data = array('url' => 'matrizLey/update/'.$matrizley->id, 'class'=>"form-horizontal");
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'matrizLey/insert', 'class'=>"form-horizontal");
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       

            

             <div class="form-group">
               <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Nombre </label>

                <div class="col-md-9">
                {{Form::text('nombre', $matrizley->nombre, array("class"=>"form-control"))}}
                </div>
            </div>

             <div class="form-group">
             <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Articulo </label>

              <div class="col-md-9">
            {{Form::text('articulo', $matrizley->articulo, array("class"=>"form-control"))}}
              </div>
            </div>


            <div class="form-group">
             <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Descripcion </label>

              <div class="col-md-9">

            {{Form::textarea('descripcion', $matrizley->descripcion, array("class"=>"form-control"))}}
              </div>
            </div>


             <div class="form-group">
             <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Evidencia </label>

              <div class="col-md-9">
            {{Form::text('evidencia', $matrizley->evidencia, array("class"=>"form-control"))}}
              </div>
            </div>


            <div class="form-group">
             <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Cumple </label>

              <div class="col-md-9">
            {{Form::select('cumple', array("si"=>"si","no"=>"no","noaplica"=>"noaplica"), $matrizley->cumple, array("class"=>"form-control"))}}
              </div>
            </div>

            <div class="form-group">
             <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Responsable </label>

              <div class="col-md-9">
            {{Form::text('responsable', $matrizley->responsable, array("class"=>"form-control"))}}
              </div>
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



@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Producto
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
    if ($producto->exists):
        $form_data = array('url' => 'producto/update/'.$producto->id, 'files'=>true);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'producto/insert', 'class'=>'class="form-horizontal', 'files'=>true);
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       
            <div class="form-group">
            {{Form::label('Nombre', 'Nombre',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('nombre', $producto->nombre)}}
            </div>

         <div class="form-group">
            {{Form::label('', 'Codigo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('codigo', $producto->codigo)}}
            </div>


            <div class="form-group">
            {{Form::label('', 'Unidad',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('unidad', $producto->unidad)}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Tipo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('tipoproducto', array(1=>"Insumo",2=>"Herramienta"), $producto->tipoproducto)}}
            </div>



            
         

     
           
         
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$('.input-mask-date').mask('99/99/9999');
$('.input-mask-date2').mask('99/99/9999');


$( "#productoactive" ).addClass( "active" );
    
  });   
</script>

@stop



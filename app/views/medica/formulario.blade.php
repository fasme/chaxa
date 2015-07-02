@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Atencion Medica
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
    if ($medica->exists):
        $form_data = array('url' => 'medica/update/'.$medica->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'medica/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       
  

            <div class="form-group">
            {{Form::label('', 'Personal',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('personal_id', $personal, $medica->personal_id)}}
            </div>


             
             <div class="form-group">
            {{Form::label('', 'Dia Turno',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('diaturno', $medica->diaturno)}}
            <small>Ejemplo: 1/14</small>
            </div>

             <div class="form-group">
            {{Form::label('', 'Diagnostico',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::textarea('diagnostico', $medica->diagnostico)}}
            
            </div>

             <div class="form-group">
            {{Form::label('', 'Tratamiento',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::textarea('tratamiento', $medica->tratamiento)}}
            </div>

             <div class="form-group">
            {{Form::label('', 'Edad',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('edad', $medica->edad)}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Domicilio',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('domicilio', $medica->domicilio)}}
            </div>

            


           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$( "#medicaactive" ).addClass( "active" );
    
  });   
</script>

@stop



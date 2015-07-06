@extends('portal.layouts')

@section('contenido')

<body class="homepage">
<section id="services" class="service-item">
       <div class="container">
           
<div class="center wow fadeInDown">
                <h2>Perfil</h2>
             </div>


            <div class="row">
            @if (Auth::check())





  <div class="col-xs-12">

           <?php

        $form_data = array('url' => 'personal/cambiarclave/'.$personal->id, 'files'=>true);
        $action    = 'Editar';
   

?>


{{ Form::open($form_data) }}


    
													
<div class="well">


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



{{Form::hidden('id', $personal->id,  array("id"=>"mantencionrealizada", "class"=>"calculos"))}}
           


			<div class="form-group">
            {{Form::label('', 'Nombre', array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('horometro', $personal->nombre,  array("readonly"=>"readonly"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Rut', array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('horometro', $personal->rut,  array("readonly"=>"readonly"))}}

            </div>


			<div class="form-group">
            {{Form::label('', 'Contraseña Actual',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::password('actual', $personal->horometro,  array("id"=>"mantencionrealizada", "class"=>"calculos"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Contraseña Nueva',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::password('nueva', $personal->horometro,  array("id"=>"mantencionrealizada", "class"=>"calculos"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Repite Contraseña Nueva',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::password('nueva_confirmation', $personal->horometro,  array("id"=>"mantencionrealizada", "class"=>"calculos"))}}
            </div>
       
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



												
									</div>
</div>






            

         


    
</div>






@endif
                
                                                   
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->

    






</body>

    



    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mantencion</h4>
      </div>
      <div class="modal-body">


      <div class="modal-footer">
    
        
      </div>
    </div>
  </div>
</div>
</div>

  

    








    <script type="text/javascript">


 $(document).ready(function() {


  $( "#mantencionactive" ).addClass( "active" );






});
 </script>

@stop
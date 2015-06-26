@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Noticia
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
    if ($noticia->exists):
        $form_data = array('url' => 'noticia/update/'.$noticia->id, "id"=>"myform","files"=>true);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'noticia/insert', 'class'=>'class="form-horizontal', "id"=>"myform", "files"=>true);
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       
            <div class="form-group">
            {{Form::label('Nombre', 'Titulo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::text('titulo', $noticia->titulo)}}
            </div>



    <div class="wysiwyg-editor" id="editor1">{{$noticia->descripcion}}</div>
        
     

<div class="form-group">
            {{Form::label('', 'Archivo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::file('archivo1', array("id"=>"id-input-file-1"))}}
            </div>


            <div class="form-group">
            {{Form::label('', 'Archivo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::file('archivo2', array("id"=>"id-input-file-2"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Archivo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::file('archivo3', array("id"=>"id-input-file-3"))}}
            </div>

            <div class="form-group">
            {{Form::label('', 'Archivo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::file('archivo4', array("id"=>"id-input-file-4"))}}
            </div>



             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   
//$('#id-input-file-2').ace_file_input('show_file_list', ['myfile.txt']);

$('#id-input-file-2, #id-input-file-1, #id-input-file-3, #id-input-file-4').ace_file_input({
          no_file:'No File ...',
          btn_choose:'Choose',
          btn_change:'Change',
          droppable:false,
          onchange:null,
          thumbnail:false
           //| true | large
          //whitelist:'gif|png|jpg|jpeg'
          //blacklist:'exe|php'
          //onchange:''
          //
        });




$('#editor1').ace_wysiwyg({
    toolbar:
    [
      'font',
      null,
      'fontSize',
      null,
      {name:'bold', className:'btn-info'},
      {name:'italic', className:'btn-info'},
      {name:'strikethrough', className:'btn-info'},
      {name:'underline', className:'btn-info'},
      null,
      {name:'insertunorderedlist', className:'btn-success'},
      {name:'insertorderedlist', className:'btn-success'},
      {name:'outdent', className:'btn-purple'},
      {name:'indent', className:'btn-purple'},
      null,
      {name:'justifyleft', className:'btn-primary'},
      {name:'justifycenter', className:'btn-primary'},
      {name:'justifyright', className:'btn-primary'},
      {name:'justifyfull', className:'btn-inverse'},
      null,
      {name:'createLink', className:'btn-pink'},
      {name:'unlink', className:'btn-pink'},
      null,
      {name:'insertImage', className:'btn-success', choose_file: false},

      null,
      'foreColor',
      null,
      {name:'undo', className:'btn-grey'},
      {name:'redo', className:'btn-grey'}
    ],
});



$('#myform').on('submit', function() {
  var hidden_input =
  $('<input type="hidden" name="descripcion" />')
  .appendTo('#myform');

  var html_content = $('#editor1').html();
  hidden_input.val( html_content );
  //put the editor's HTML into hidden_input and it will be sent to server
});



$( "#noticiaactive" ).addClass( "active" );
    
  });   
</script>

@stop



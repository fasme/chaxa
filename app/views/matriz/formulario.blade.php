@extends('layouts.master')
 

 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
            Matriz
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
    if ($matriz->exists):
        $form_data = array('url' => 'matriz/update/'.$matriz->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'matriz/insert', 'class'=>'class="form-horizontal');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       

            

            <div class="widget-box">
                      <div class="widget-header widget-header-small">
                        <h5 class="widget-title smaller">Tabbed</h5>

                        <div class="widget-toolbar no-border">
                          <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                              <a data-toggle="tab" href="#uno">1.-Identificacion de Peligro</a>
                            </li>

                            <li>
                              <a data-toggle="tab" href="#dos">2.-Evaluacion del Riesgo Base</a>
                            </li>

                            <li>
                              <a data-toggle="tab" href="#tres">3.-Controles Preventivos</a>
                            </li>
                            

                          </ul>
                        </div>
                      </div>

                      <div class="widget-body">
                        <div class="widget-main padding-6">
                          <div class="tab-content">
                            <div id="uno" class="tab-pane in active">

                            <div class="form-group">
                              {{Form::label('', 'Proceso',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('proceso', $matriz->proceso)}}
                              </div>
                              


                               <div class="form-group">
                              {{Form::label('', 'Peligro',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('matriz_peligro_id', $matrizPeligro, "", array("class"=>"chosen-select"))}}
                              </div>


                              <?php
                              $array = Matriz::find($matriz->id);
                              $arrayName = "";
                              if(count($array) >0)
                              {

                              foreach ($array->muchasactividad as $key) {
                                $arrayName[] = $key->id;
                               
                              }
                            }

                              ?>

                              <div class="form-group">
                              {{Form::label('', 'Actividad',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('actividad_id[]', $matrizActividad, $arrayName, array("class"=>"chosen-select", "multiple"=>"multiple"))}}
                              </div>

                              <?php
                               
                              if(count($array)>0)
                              {


                              foreach ($array->muchasriesgo as $key) {
                                $arrayName[] = $key->id;
                               
                              }
                            }

                              ?>

                              <div class="form-group">
                              {{Form::label('', 'Riesgo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('riesgo_id[]', $matrizRiesgo, $arrayName, array("class"=>"chosen-select", "multiple"=>"multiple"))}}
                              </div>

                              <div class="form-group">
                              {{Form::label('', 'Rutinaria',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('rutinaria', array("si"=>"si","no"=>"no"), "")}}
                              </div>

                              <?php
                           
                               if(count($array)>0)
                              {
                              foreach ($array->muchascargo as $key) {
                                $arrayName[] = $key->id;
                               
                              }
                            }
                              ?>

                              <div class="form-group">
                              {{Form::label('', 'Cargo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('cargo_id[]', $matrizCargo, $arrayName, array("class"=>"chosen-select", "multiple"=>"multiple"))}}
                              </div>


                            </div>

                            <div id="dos" class="tab-pane">

                             <div class="form-group">
                              {{Form::label('', 'Factor Consecuencia',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('factorseveridad', $criterioConsecuencia, $matriz->factorseveridad, array("class"=>"fun1", "id"=>"factor1"))}}
                              </div>
                              <div class="form-group">
                              {{Form::label('', 'Factor Exposicion',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('factorexposicion', $criterioExposicion, $matriz->factorxposicion, array("class"=>"fun1", "id"=>"factor2"))}}
                              </div>

                              <div class="form-group">
                              {{Form::label('', 'Factor Probabilidad',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::select('factorprobabilidad', $criterioProbabilidad, $matriz->factorprobabilidad, array("class"=>"fun1", "id"=>"factor3"))}}
                              </div>

                              <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultado', $matriz->resultado, array("id"=>"resultado1", "readonly"=>"readonly"))}}
                              </div>

                              <div id="color1">
                             <br>
                              </div>


                            </div>

                            <div id="tres" class="tab-pane">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                  {{Form::label('', 'Previo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::textarea('actprevio', $matriz->actprevio, ['size' => '30x5'])}}
                                  </div>

                                  <div class="form-group">
                                  {{Form::label('', 'Total',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::select('totalprevio', array(0=>"0",1=>"1",2=>"2",3=>"3",4=>"4",5=>"5",6=>"6",7=>"7",8=>"8",9=>"9",10=>"10"), $matriz->totalprevio, array("class"=>"fun2", "id"=>"factorprevio"))}}
                                  </div>

                                  <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultadoprevio', $matriz->resultadoprevio, array("id"=>"resultado2", "readonly"=>"readonly"))}}
                              </div>

                                  <div class="hr hr-24"></div>


                                  <div class="form-group">
                                  {{Form::label('', 'Sustitucion',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::textarea('actsustitucion', $matriz->actsustitucion, ['size' => '30x5'])}}
                                  </div>

                                  <div class="form-group">
                                  {{Form::label('', 'Total',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::select('totalsustitucion', array(0=>"0",1=>"1",2=>"2",3=>"3",4=>"4",5=>"5",6=>"6",7=>"7",8=>"8",9=>"9",10=>"10"), $matriz->totalsustitucion, array("class"=>"fun2", "id"=>"factorsustitucion"))}}
                                  </div>
,
                                  <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultadosustitucion', $matriz->resultadosustitucion, array("id"=>"resultado4", "readonly"=>"readonly"))}}
                              </div>

<div class="hr hr-24"></div>

                              <div class="form-group">
                                  {{Form::label('', 'Administrativo',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::textarea('actadministrativo', $matriz->actadministrativo, ['size' => '30x5'])}}
                                  </div>

                                  <div class="form-group">
                                  {{Form::label('', 'Total',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::select('totaladministrativo', array(0=>"0",1=>"1",2=>"2",3=>"3",4=>"4",5=>"5",6=>"6",7=>"7",8=>"8",9=>"9",10=>"10"), $matriz->totaladministrativo, array("class"=>"fun2", "id"=>"factoradministrativo"))}}
                                  </div>

                                  <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultadoadministrativo', $matriz->resultadoadministrativo, array("id"=>"resultado6", "readonly"=>"readonly"))}}
                              </div>

                              <div class="hr hr-24"></div>


                              <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('magnitud', $matriz->magnitud, array("id"=>"magnitud", "readonly"=>"readonly"))}}
                              </div>

                                </div>
                                <div class="col-xs-6">
                                      <div class="form-group">
                                  {{Form::label('', 'Eliminacion',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::textarea('acteliminacion', $matriz->acteliminacion, ['size' => '30x5'])}}
                                  </div>

                                  <div class="form-group">
                                  {{Form::label('', 'Total',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::select('totaleliminacion', array(0=>"0",1=>"1",2=>"2",3=>"3",4=>"4",5=>"5",6=>"6",7=>"7",8=>"8",9=>"9",10=>"10"), $matriz->totaleliminacion, array("class"=>"fun2", "id"=>"factoreliminacion"))}}
                                  </div>

                                  <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultadoeliminacion', $matriz->resultadoeliminacion, array("id"=>"resultado3", "readonly"=>"readonly"))}}
                              </div>

<div class="hr hr-24"></div>

                              <div class="form-group">
                                  {{Form::label('', 'Ingenieria',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::textarea('actingenieria', $matriz->actingenieria, ['size' => '30x5'])}}
                                  </div>

                                  <div class="form-group">
                                  {{Form::label('', 'Total',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::select('totalingenieria', array(0=>"0",1=>"1",2=>"2",3=>"3",4=>"4",5=>"5",6=>"6",7=>"7",8=>"8",9=>"9",10=>"10"), $matriz->totalingenieria, array("class"=>"fun2", "id"=>"factoringenieria"))}}
                                  </div>

                                  <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultadoingenieria', $matriz->resultadoingenieria, array("id"=>"resultado5", "readonly"=>"readonly"))}}
                              </div>
<div class="hr hr-24"></div>

                              <div class="form-group">
                                  {{Form::label('', 'EPP',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::textarea('actepp', $matriz->actepp, ['size' => '30x5'])}}
                                  </div>

                                  <div class="form-group">
                                  {{Form::label('', 'Total',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                                  {{Form::select('totalepp', array(0=>"0",1=>"1",2=>"2",3=>"3",4=>"4",5=>"5",6=>"6",7=>"7",8=>"8",9=>"9",10=>"10"), $matriz->totalepp, array("class"=>"fun2", "id"=>"factorepp"))}}
                                  </div>

                                  <div class="form-group">
                              {{Form::label('', 'Resultado',array("class"=>"col-sm-3 control-label no-padding-right"))}}
                              {{Form::text('resultadoepp', $matriz->resultadoepp, array("id"=>"resultado7", "readonly"=>"readonly"))}}
                              </div>

                              <div class="hr hr-24"></div>

                              <div id="color2">
                             <br>
                              </div>


                                </div>
                              </div>
                            </div>



                            
                          </div>
                        </div>
                      </div>



            

           



           

           
        
     

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$(".fun1").change(function(){

var  factor1 = $("#factor1").val();
var  factor2 = $("#factor2").val();
var  factor3 = $("#factor3").val();
var resultado = factor1 * factor2 * factor3;
$("#resultado1").val(resultado);

$.get("{{url('matriz/cargarMatrizColor')}}",
  {resultado:resultado},
  function(data){
    $("#color1").css("background-color",data);
     });
});


$(".fun2").change(function(){

var factorprevio = $("#factorprevio").val();
var resultado2 = Math.pow(0.8,factorprevio) + ((1-(Math.pow(0.8,factorprevio)))*80)/100;
$("#resultado2").val(resultado2);

var factorsustitucion = $("#factorsustitucion").val();
var resultado4 = Math.pow(0.35,factorsustitucion);
$("#resultado4").val(resultado4);

var factoradministrativo = $("#factoradministrativo").val();
var resultado6 = Math.pow(0.8,factoradministrativo);
$("#resultado6").val(resultado6);

var factoreliminacion = $("#factoreliminacion").val();
var resultado3 = Math.pow(0.2,factoreliminacion);
$("#resultado3").val(resultado3);


var factoringenieria = $("#factoringenieria").val();
var resultado5 = Math.pow(0.6,factoringenieria);
$("#resultado5").val(resultado5);

var factorepp = $("#factorepp").val();
var resultado7 = Math.pow(0.9,factorepp);
$("#resultado7").val(resultado7);


var magnitud = resultado2 * resultado3 * resultado4 * resultado5 * resultado6 * resultado7;
$("#magnitud").val(magnitud);

$.get("{{url('matriz/cargarMatrizColor')}}",
  {resultado:magnitud},
  function(data){
    $("#color2").css("background-color",data);
     });

});

$( "#matrizactive" ).addClass( "active" );
$( "#matrizmatrizactive" ).addClass( "active" );


$('.chosen-select').chosen(); 

    
  });   
</script>

@stop



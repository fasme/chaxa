@extends('layouts.master')

@section('contenido')

            

 <h3 class="header smaller lighter">Actividades Programadas vs Actividades Realizadas Anual: 
                
    </h3>
{{$programada}}
<?php
$meses = array(1=>"Enero",2=>"Feberero", 3=>"Marzo",4=>"Abril",5=>"Mayo",6=>"Junio",7=>"Julio",8=>"Agosto",9=>"Septiembre",10=>"Octubre",11=>"Noviembre",12=>"Diciembre");
$mesnombre = $meses[$data["mes"]];
?>


<div class="row">
  <div class="col-xs-12">
      <div class="alert alert-block alert-success">

      {{ Form::open(array('url' => "informemantencionvehiculo", "method"=>"get")) }}
            <div class="form-group">
            {{Form::label('', 'Fecha',array("class"=>"col-sm-3 control-label no-padding-right"))}}
            {{Form::select('mes',$meses, $data["mes"])}}

            {{Form::select('ano',array("2015"=>"2015","2016"=>"2016","2017"=>"2017","2018"=>"2018"), $data["ano"])}}
            {{Form::submit()}}

      {{ Form::close()}}
            </div>
      </div>
</div>
</div>

 <div class="row">
  <div class="col-xs-9">
 <canvas id="myChart1" width="800" height="300"></canvas>
 </div>
 <div class="col-xs-3">
 <div id="chart1"></div>
  <a class="label label-success" href='' download="GraficoAnual.png"  id="img1">Descargar Grafico</a>


 </div>
 </div>




   
<script type="text/javascript">
    
     $(document).ready(function() {

      $( "#informeactive" ).addClass( "active" );


      var ctx = document.getElementById("myChart1").getContext("2d");

     var arreglo = new Array();
     var ve;
for (var i=0; i<3; i++) { 
 arreglo[i] = "asde,"; 
 ve = ve+"_"+i;
}

 var data = {
    labels: {{$vehiculos}},
    datasets: [
        {
            label: "Horas Utilizadas",
            fillColor: "#FA5858",
          //  strokeColor: "rgba(220,220,220,0.8)",
           // highlightFill: "rgba(220,220,220,0.75)",
           // highlightStroke: "rgba(220,220,220,1)",
            data: {{$programada}}
        },
        {
            label: "Cantidad de mantenciones realizadas",
            fillColor: "#5882FA",
           // strokeColor: "rgba(151,187,205,0.8)",
           // highlightFill: "rgba(151,187,205,0.75)",
           // highlightStroke: "rgba(151,187,205,1)",
            data: {{$realizada}}
        }
    ]
};

var options = {
  legendTemplate : '<ul>'
                  +'<% for (var i=0; i<datasets.length; i++) { %>'
                    +'<li>'
                    +'<span style=\"background-color:<%=datasets[i].fillColor%>\">  &nbsp;&nbsp;  &nbsp;&nbsp;</span>'
                    +'<% if (datasets[i].label) { %><%= datasets[i].label %><% } %>'
                  +'</li>'
                +'<% } %>'
              +'</ul>',

              animation: false,

  };



var myBarChart = new Chart(ctx).Bar(data,options);
var legend = myBarChart.generateLegend();


var url=myBarChart.toBase64Image();
    document.getElementById("img1").href=url;

  //and append it to your page somewhere
  $('#chart1').append(legend);




});

</script>
    

@stop

@extends('layouts.master')

@section('contenido')

            

 <h3 class="header smaller lighter">Actividades Programadas vs Actividades Realizadas Anual: 
                
    </h3>



<div class="row">
  <div class="col-xs-12">
      <div class="alert alert-block alert-success">

      {{ Form::open(array('url' => "informemantencionanual", "method"=>"get")) }}
            <div class="form-group">
            

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


 var data = {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
    datasets: [
        {
            label: "Mantencion Programadas",
            fillColor: "#FA5858",
          //  strokeColor: "rgba(220,220,220,0.8)",
           // highlightFill: "rgba(220,220,220,0.75)",
           // highlightStroke: "rgba(220,220,220,1)",
            data: [{{$programada["0"]}},{{$programada["1"]}},{{$programada["2"]}},{{$programada["3"]}},{{$programada["4"]}},{{$programada["5"]}},{{$programada["6"]}},{{$programada["7"]}},{{$programada["8"]}},{{$programada["9"]}},{{$programada["10"]}},{{$programada["11"]}}]
        },
        {
            label: "Mantencion Realizadas",
            fillColor: "#5882FA",
           // strokeColor: "rgba(151,187,205,0.8)",
           // highlightFill: "rgba(151,187,205,0.75)",
           // highlightStroke: "rgba(151,187,205,1)",
            data: [{{$realizada["0"]}},{{$realizada["1"]}},{{$realizada["2"]}},{{$realizada["3"]}},{{$realizada["4"]}},{{$realizada["5"]}},{{$realizada["6"]}},{{$realizada["7"]}},{{$realizada["8"]}},{{$realizada["9"]}},{{$realizada["10"]}},{{$realizada["11"]}}]
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
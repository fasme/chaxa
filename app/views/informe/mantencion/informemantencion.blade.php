@extends('layouts.master')

@section('contenido')

 <b><h1>Grafico de pruebas NO CORRESPONDE A LOS DATOS INGRESADOS</h1></b><br><br>
 <canvas id="myChart" width="800" height="400"></canvas>
 <br>
 Linea Roja = Horometro Actual<br>
 Linea Azul = Horometro Proxima Mantencion<br>
 Esste grafico permite ver todos los vehiculos con su horometro actual y su horometro de la proxima mantencion,
  para visualizar que vehiculo esta por cumplir su mantencin



   
<script type="text/javascript">
    
     $(document).ready(function() {
     var ctx = document.getElementById("myChart").getContext("2d");


     var data = {
    labels: ["Vehiculo 1", "Vehiculo 2", "Vehiculo 3", "Vehiculo 4"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "red",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [1000, 2000, 1300, 1200]
        },
        {
            label: "My First dataset",
             fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "blue",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [1250, 2250, 1500, 1250]
        }
    ]
};



var myLineChart = new Chart(ctx).Line(data);

});

</script>
    

@stop
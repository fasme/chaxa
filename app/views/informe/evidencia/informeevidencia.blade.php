@extends('layouts.master')

@section('contenido')















<?php
$actividadresponsable = DB::table('actividad_responsable_noprogramada')->Where("estado","<>","Abierta")->get();
$actividadresponsable_kpi = DB::table('actividad_responsable_kpi')->Where("estado","<>","Abierta")->get();
$actividadresponsable_programada = DB::table('actividad_responsable_programada')->Where("estado","<>","Abierta")->get();

$actividadresponsable_pac = DB::table('actividad_responsable_pac')->Where("estado","<>","Abierta")->get();
?>

<div class="row">


 <h3 class="header smaller lighter">Envio de Evidencias: 
                
    </h3>


 <table id="example" class="table table-striped table-bordered table-hover">

                        <thead>
                          <tr>
                            
                            <th>Actividad</th>
                            <th>Personal</th>
                        
                             <th>Estado</th>
                            <th>Plazo</th>

                           
                            

                           
                          </tr>
                        </thead>

                         <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                  <th>Position</th>
                    <th></th>
                      
               
            </tr>
        </tfoot>


                        <tbody>

                        
                        
                             @foreach($actividadresponsable as $actividad)

                              <?php
                           $busqueda = "";
                            ?>

                            <?php
                             $busqueda = ActividadNoProgramada::find($actividad->actividad_id);
                            ?>
                            

                         
                            
                          <tr>
                            
                        
                           <?php
                            $datetime1 = new DateTime($busqueda->frecuencia);
                            $datetime2 = new DateTime($actividad->fechaenvio);
                            $interval = $datetime1->diff($datetime2);
                            if($interval->format("%R") == "+")
                            {
                              $dif = "<font color='red'>Esta Evidencia se envio con (". $interval->format('%a')." Dias) de Atraso</font>";
                            }
                            else
                            {
                              $dif = "<font color='green'>Esta evidencia se envio con (". $interval->format('%a')." Dias) de anticipacion</font>";
                            }
                             
                            ?>

                            <td>{{ $busqueda->actividad}}</td>
                            <td>{{Personal::find($actividad->personal_id)->nombre}}</td>
                          
                            <td>{{$actividad->estado}}</td>
                            <td>{{$dif}}</td>
                            
                            </tr>
                                @endforeach









                                 @foreach($actividadresponsable_kpi as $actividad)

                              <?php
                           $busqueda = "";
                            ?>

                           
                            <?php
                            $busqueda = ActividadKpi::find($actividad->actividad_id);
                              ?>
                          

                         
                            
                          <tr>
                            
                        
                          <?php
                            $datetime1 = new DateTime($busqueda->frecuencia);
                            $datetime2 = new DateTime($actividad->fechaenvio);
                            $interval = $datetime1->diff($datetime2);
                            if($interval->format("%R") == "+")
                            {
                              $dif = "<font color='red'>Esta Evidencia se envio con (". $interval->format('%a')." Dias) de Atraso</font>";
                            }
                            else
                            {
                              $dif = "<font color='green'>Esta evidencia se envio con (". $interval->format('%a')." Dias) de anticipacion</font>";
                            }
                             
                            ?>
                            ?>

                            <td>{{ $busqueda->actividad}}</td>
                            <td>{{Personal::find($actividad->personal_id)->nombre}}</td>
                          
                            <td>{{$actividad->estado}}</td>
                            <td> {{$dif}}</td>
                         
                            </tr>
                                @endforeach









                                 @foreach($actividadresponsable_programada as $actividad)

                              <?php
                           $busqueda = "";
                            ?>

                         
                            <?php 
                            $busqueda = ActividadProgramada::find($actividad->actividad_id);
                            ?>
                            

                         
                            
                          <tr>
                            
                        
                           <?php
                            $datetime1 = new DateTime($busqueda->frecuencia);
                            $datetime2 = new DateTime($actividad->fechaenvio);
                            $interval = $datetime1->diff($datetime2);
                            if($interval->format("%R") == "+")
                            {
                              $dif = "<font color='red'>Esta Evidencia se envio con (". $interval->format('%a')." Dias) de Atraso</font>";
                            }
                            else
                            {
                              $dif = "<font color='green'>Esta evidencia se envio con (". $interval->format('%a')." Dias) de anticipacion</font>";
                            }
                             
                            ?>

                            <td>{{ $busqueda->actividad}}</td>
                            <td>{{Personal::find($actividad->personal_id)->nombre}}</td>
                          
                            <td>{{$actividad->estado}}</td>
                            <td> {{$dif}}</td>
                           
                            </tr>
                                @endforeach









                                 @foreach($actividadresponsable_pac as $actividad)

                              <?php
                           $busqueda = "";
                            ?>

                          
                        
                            <?php
                            $busqueda = ActividadPac::find($actividad->actividad_id);
                              ?>
                          

                         
                            
                          <tr>
                            
                        
                           <?php
                            $datetime1 = new DateTime($busqueda->frecuencia);
                            $datetime2 = new DateTime($actividad->fechaenvio);
                            $interval = $datetime1->diff($datetime2);
                            if($interval->format("%R") == "+")
                            {
                              $dif = "<font color='red'>Esta Evidencia se envio con (". $interval->format('%a')." Dias) de Atraso</font>";
                            }
                            else
                            {
                              $dif = "<font color='green'>Esta evidencia se envio con (". $interval->format('%a')." Dias) de anticipacion</font>";
                            }
                             
                            ?>

                            <td>{{ $busqueda->actividad}}</td>
                            <td>{{Personal::find($actividad->personal_id)->nombre}}</td>
                          
                            <td>{{$actividad->estado}}</td>
                            <td> {{$dif}}</td>
                            
                            </tr>
                                @endforeach
                           
                            
                            </tbody>



                           


                            </table>







                
                                                   
            </div><!--/.row-->
    







    

  

    








    <script type="text/javascript">


 $(document).ready(function() {


$( "#evidenciaactive" ).addClass( "active" );

/*
$('#example tfoot th').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
*/
$('#example tfoot th').eq(0).html( '<input type="text" placeholder="Buscar " style="width:50px" />' );
$('#example tfoot th').eq(1).html( '<input type="text" placeholder="Buscar " style="width:50px" />' );
$('#example tfoot th').eq(2).html( '<input type="text" placeholder="Buscar " style="width:50px" />' );


var table = $('#example').DataTable({

   "language": {
                "url": "datatables.spanish.json"
            }
          }
            );

table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );




});
 </script>

@stop
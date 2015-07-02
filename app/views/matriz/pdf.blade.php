<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
$html ="";
$html .= "<h1>Identificacion de Peligros, Valoración de Riesgos y Determinacion</h1>";
$html .= "<table width='100%' border='1' style='font-size:15px;'>
<tr style='background-color:#D8D8D8'><th colspan='6' height='25'>IDENTIFICACION DEL PELIGRO</th><th colspan='5'>EVALUACION DEL RIESGO</th><th colspan='12' height='25'>CONTROLES PREVENTIVOS: PRIORIZACION DEL CONTROL</th><th colspan='2'>RIESGO RESIDUAL</th></tr>
<tr style='background-color:#F2F2F2'><th>Proceso</th><th>Actividad</th><th>Cargo</th><th>Peligro</th><th>R</th><th>Riesgo</th>
<th>F. Sev.</th><th>F. Exp.</th><th>F. Prob.</th><th>Res.</th><th>Clas.</th>
<th>Previo</th><th>Factor</th><th>Eliminacion</th><th>Factor</th><th>Sustitucion</th><th>Factor</th><th>Ingenieria</th><th>Factor</th><th>Administrativo</th><th>Factor</th><th>Epp</th><th>Factor</th>
<th>Mag.</th><th>Res.</th>

</tr>
";
?>


@foreach($matrizs as $matriz)

<?php
$html .= "<tr>";
$html .= "<td height='100'>".$matriz->proceso."</td>";
$html .= "<td>";
foreach ($matriz->muchasactividad as $value) {
$html.=	$value->nombre." <br>";
}
$html .= "</td>";
$html .= "<td>";
foreach ($matriz->muchascargo as $value) {
$html.=	$value->nombre."<br>";
}
$html .= "</td>";
$html .= "<td>".$matriz->peligro->nombre."</td>";
$html .= "<td>".$matriz->rutinaria."</td>";

$html .= "<td>";
foreach ($matriz->muchasriesgo as $value) {
$html.=	$value->nombre."<br>";
}
$html .= "</td>";
$html .= "<td>".$matriz->factorseveridad."</td>";
$html .= "<td>".$matriz->factorexposicion."</td>";
$html .= "<td>".$matriz->factorprobabilidad."</td>";
$html .= "<td>".$matriz->resultado."</td>";

$clasificacion = Clasificacion::Where("desde","<=",$matriz->resultado)->Where("hasta",">",$matriz->resultado)->first();

$html .= "<td bgcolor=".$clasificacion->color."></td>";





$html .= "<td>".$matriz->actprevio."</td>";
$html .= "<td>".number_format($matriz->resultadoprevio,3)."</td>";
$html .= "<td>".$matriz->acteliminacion."</td>";
$html .= "<td>".number_format($matriz->resultadoeliminacion,3)."</td>";
$html .= "<td>".$matriz->actsustitucion."</td>";
$html .= "<td>".number_format($matriz->resultadosustitucion,3)."</td>";
$html .= "<td>".$matriz->actingenieria."</td>";
$html .= "<td>".number_format($matriz->resultadoingenieria,3)."</td>";
$html .= "<td>".$matriz->actadministrativo."</td>";
$html .= "<td>".number_format($matriz->resultadoadministrativo,3)."</td>";
$html .= "<td>".$matriz->actepp."</td>";
$html .= "<td>".number_format($matriz->resultadoepp,3)."</td>";


$html .= "<td>".number_format($matriz->magnitud,3)."</td>";
$clasificacion = Clasificacion::Where("desde","<=",$matriz->resultado)->Where("hasta",">",$matriz->resultado)->first();

$html .= "<td bgcolor=".$clasificacion->color."></td>";

$html .= "</tr>";
?>

@endforeach


<?php
$html .="</table>";
$html .= "<br><table style='page-break-after:always;'></br></table><br>";  
?>






<?php

/*
$html .= "<table width='100%' border='1'>
<tr style='background-color:#D8D8D8'><th colspan='12' height='25'>CONTROLES PREVENTIVOS: PRIORIZACION DEL CONTROL</th></tr>
<tr style='background-color:#F2F2F2'><th>Previo</th><th>Factor</th><th>Eliminacion</th><th>Factor</th><th>Sustitucion</th><th>Factor</th><th>Ingenieria</th><th>Factor</th><th>Administrativo</th><th>Factor</th><th>Epp</th><th>Factor</th></tr>
";
*/
?>


@foreach($matrizs as $matriz)

<?php
/*
$html .= "<tr>";
$html .= "<td height='100'>".$matriz->actprevio."</td>";
$html .= "<td>".$matriz->resultadoprevio."</td>";
$html .= "<td>".$matriz->acteliminacion."</td>";
$html .= "<td>".$matriz->resultadoeliminacion."</td>";
$html .= "<td>".$matriz->actsustitucion."</td>";
$html .= "<td>".$matriz->resultadosustitucion."</td>";
$html .= "<td>".$matriz->actingenieria."</td>";
$html .= "<td>".$matriz->resultadoingenieria."</td>";
$html .= "<td>".$matriz->actadministrativo."</td>";
$html .= "<td>".$matriz->resultadoadministrativo."</td>";
$html .= "<td>".$matriz->actepp."</td>";
$html .= "<td>".$matriz->resultadoepp."</td>";
$html .= "</tr>";
*/
?>

@endforeach





<?php


$html .= "<table width='100%' border='1'>
<tr style='background-color:#D8D8D8'><th colspan='1'>MATRIZ LEGAL</th></tr>

<tr style='background-color:#F2F2F2'><th>Leyes</th>
</tr>";
?>


@foreach($matrizs as $matriz)

<?php
$html .= "<tr>";
/*
$html .= "<td height='100'>".$matriz->magnitud."</td>";
$clasificacion = Clasificacion::Where("desde","<=",$matriz->resultado)->Where("hasta",">",$matriz->resultado)->first();

$html .= "<td bgcolor=".$clasificacion->color."></td>";
*/

$html .= "<td>";

foreach ($matriz->muchasactividad as $value) {
	$html.= "<b>".$value->nombre.":</b>";
		foreach ($value->muchasley as $value2) {
			$html.= $value2->nombre.":".$value2->descripcion. ":<br>";
			
				}

				$html.= "<br>";

		}

$html .= "</td>";
$html .= "</tr>";
?>

@endforeach


<?php
$html .="</table>";
$html .= "<br><table style='page-break-after:always;'></br></table><br>";  
?>






<?php
$html .="</table><br>";
//$html .= "<br><table style='page-break-after:always;'></br></table><br>";  
?>


<?php
$html .= "<table width='50%' border='1'><tr><th>Version</th><th>Cambio</th></tr>";
?>
@foreach(Cambio::all() as $cambio)
<?php


$html .= "<tr><td>$cambio->version</td><td>$cambio->descripcion</td></tr>";

?>
@endforeach
<?php
$html .= "</table>"
?>
<?php
echo $html;
?>
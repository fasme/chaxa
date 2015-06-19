<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
$html ="";
$html .= "<h1>Identificacion de Peligros, Valoración de Riesgos y Determinacion</h1>";
$html .= "<table width='100%' border='1'>
<tr style='background-color:#D8D8D8'><th colspan='6' height='25'>IDENTIFICACION DEL PELIGRO</th><th colspan='5'>EVALUACION DEL RIESGO</th></tr>
<tr style='background-color:#F2F2F2'><th>Proceso</th><th>Actividad</th><th>Cargo</th><th>Peligro</th><th>Rutinaria</th><th>Riesgo</th>
<th>Factor Severidad</th><th>Factor Exposicion</th><th>Factor Probabilidad</th><th>Resultado</th><th>Clasificacion</th>
</tr>
";
?>




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
$html .= "</tr>";
?>




<?php
$html .="</table>";
$html .= "<br><table style='page-break-after:always;'></br></table><br>";  
?>






<?php


$html .= "<table width='100%' border='1'>
<tr style='background-color:#D8D8D8'><th colspan='12' height='25'>CONTROLES PREVENTIVOS: PRIORIZACION DEL CONTROL</th></tr>
<tr style='background-color:#F2F2F2'><th>Previo</th><th>Factor</th><th>Eliminacion</th><th>Factor</th><th>Sustitucion</th><th>Factor</th><th>Ingenieria</th><th>Factor</th><th>Administrativo</th><th>Factor</th><th>Epp</th><th>Factor</th></tr>
";
?>




<?php
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
?>







<?php


$html .= "<table width='100%' border='1'>
<tr style='background-color:#D8D8D8'><th colspan='2' height='25'>RIESGO RESIDUAL</th><th colspan='1'>MATRIZ LEGAL</th></tr>

<tr style='background-color:#F2F2F2'><th>Magnitud</th><th>Resultado</th><th>Leyes</th>
</tr>";
?>



<?php
$html .= "<tr>";
$html .= "<td height='100'>".$matriz->magnitud."</td>";
$clasificacion = Clasificacion::Where("desde","<=",$matriz->resultado)->Where("hasta",">",$matriz->resultado)->first();

$html .= "<td bgcolor=".$clasificacion->color."></td>";
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




<?php
$html .="</table>";
$html .= "<br><table style='page-break-after:always;'></br></table><br>";  
?>






<?php
$html .="</table>";
$html .= "<br><table style='page-break-after:always;'></br></table><br>";  


echo $html;
?>
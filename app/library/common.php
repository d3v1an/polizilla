<?php
function pre($arr) {
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}
function esDateTime($strTime) {

	$dias 	= array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses 	= array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

	return $dias[date('w',$strTime)]." ".date('d',$strTime)." de ".$meses[date('n',$strTime)-1]. " del ".date('Y',$strTime) ;
}
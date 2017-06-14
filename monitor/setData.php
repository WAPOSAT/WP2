<?php

require_once ("../require/conexion.class.php");
require_once ("../require/Measurement.class.php");

$Measurement = new Measurement();

if( !empty($_GET)) {
	$estado = 1;

	if (isset($_GET["id1"])){
		$id1  = htmlspecialchars($_GET["id1"],ENT_QUOTES);
		echo "id1 ha sido enviado exitosamente, su valor es: ".$id1." ";
	} else {
		$estado = 0;
		echo "no se ha encontrado a id1 ";
	}

	/*if (isset($_GET["id2"])){
		$id2  = htmlspecialchars($_GET["id2"],ENT_QUOTES);
		echo "id2 ha sido enviado exitosamente, su valor es: ".$id2." ";
	} else {
		$estado = 0;
		echo "no se ha encontrado a id2 ";
	}*/

	if (isset($_GET["v1"])){
		$v1  = htmlspecialchars($_GET["v1"],ENT_QUOTES);
		echo "v1 ha sido enviado exitosamente, su valor es: ".$v1." ";
	} else {
		$estado = 0;
		echo "no se ha encontrado a v1 ";
	}

	/*if (isset($_GET["v2"])){
		$v2  = htmlspecialchars($_GET["v2"],ENT_QUOTES);
		echo "v2 ha sido enviado exitosamente, su valor es: ".$v2." ";
	} else {
		$estado = 0;
		echo "no se ha encontrado a v2 ";
	}*/

	if($estado == 1){

    $Measurement->set_sensor_medida($id1, $v1);

	}else {
		echo "no voy a guardar nada ...";
	}
} else{
	echo "No se ha recibido ningun valor";
}


?>

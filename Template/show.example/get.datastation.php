<?php

require_once ("../../require/conexion.class.php");
require_once ("../../require/Block_Sensors.class.php");
require_once ("../../require/Blocks.class.php");

$Blocks = new Blocks();
$Block_Sensors = new Block_Sensors();

$id = (float)$_GET["IdS"];
//$id=2;

$Block = $Blocks->getstation_byId($id);
// verificamos que el Id enviado pertenesca a un Block_Station que este activo
if($Block != 0){
	$Sensores = array();
	/*
	Hasta este punto se ha verificado si la informacion enviada por GET es correcta
	*/

	$name = utf8_encode($Block["block_name"]);
	$code_name = utf8_encode($Block["block_codename"]);

	$map_zoom  = 16;
	$map_LatCenter = (float)$Block["latitude"];
	$map_LngCenter = (float)$Block["longitude"];
	$LatPoint = (float)$Block["latitude"];
	$LngPoint = (float)$Block["longitude"];


	$descripcion = utf8_encode($Block["description"]);
	$imagen = $Block["image"];
	$Freq_Refresh = $Block["refresh"];

	//getSensors_visible
	$Block_Sensors->getSensors_visible ($id);

    while($valores = $Block_Sensors->retornar_SELECT()){
    	array_push($Sensores, (float)$valores["id"]);
    }

	$arr = array(
		'Id'=> $id,
		'name' => $name ,
		'code_name'=>$code_name,
		'descripcion' => $descripcion,
		'RefreshFrequencySeg' => $Freq_Refresh,
		'imagen' => $imagen,
		'sensores' => $Sensores,
		'Map' => [
			'Option' =>[
				'zoom'=> $map_zoom,
				'LatCenter'=> $map_LatCenter,
				'LngCenter'=> $map_LngCenter
				], 
			'Marker' => [
				'Lat'=> $LatPoint,
				'Lng'=> $LngPoint
				] 
			]
		);

	echo json_encode($arr);


} else {
	// aca en caso se encuentre que el Id es incorrecto
}

?>
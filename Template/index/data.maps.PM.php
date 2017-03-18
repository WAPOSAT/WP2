<?php
require_once ("../../require/conexion.class.php");
require_once ("../../require/estaciones.class.php");

$pointMarker = array();

$estaciones = new estaciones();
$estaciones->mostrar_todas();

while($marker = $estaciones->retornar_SELECT()){
    
    $Latitud = (double)$marker["Latitud"];
    $Longitud = (double)$marker["Longitud"];
    $id = (int)$marker["id_estacion"];
    $nombre = (string)$marker["nombre"];
    $codeName = (string)$marker["codeName"];
    
    $point = array('id' => $id, 'lat' =>$Latitud, 'lng' =>$Longitud, 'name' =>$nombre, 'codename' =>$codeName, 'imgpuntero'=>"../img/PointSensor.png");
    array_push($pointMarker, $point);
}
 
$mapOption = array('zoom'=>11, 'centerPosition' => [-11.899385,-77.007952]);

$arr = array('pointMarker' => $pointMarker, 'mapOption' => $mapOption );
echo json_encode($arr);

?>

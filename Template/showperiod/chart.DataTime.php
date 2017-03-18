<?php
require_once ("../../require/conexion.class.php");
require_once ("../../require/parametros.class.php");
require_once ("../../require/monitoreo.class.php");

$DataTime = array();
$DataValue = array();
$Data = array();
$lastID = 0;
$long = 0;
$LimSup = 0;
$LimInf = 0;


$parametros = new parametros();
$monitoreo = new monitoreo();

$id_parametro = $_POST["id_parametro"];
$id_equipo = $_POST["id_equipo"];
$Date1 = $_POST["date_beging"];
$Date2 = $_POST["date_end"];


$result = $monitoreo->showValuesBetweenDates ($id_parametro, $id_equipo, $Date1, $Date2);
$ValParametros = $parametros->ObtenerParametro($id_parametro);
$months = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

$LimSup = $ValParametros["LimSup"];
$LimInf = $ValParametros["LimInf"];

$firstVal = 0;
$lastVal = 0;
$AcumVal = 0;

while($valores = $monitoreo->retornar_SELECT()){
    if ($long == 0){
        $valMax = $valores["valor"];
        $valMin = $valores["valor"];
    }
    if ($valMax < $valores["valor"]){
        $valMax = $valores["valor"];
    }
    if ($valMin > $valores["valor"]){
        $valMin = $valores["valor"];
    }
    $firstVal = $valores["valor"];
    $datetmp = strtotime($valores["fecha"]);
    $horatmp = date('H',$datetmp);
    $minutotmp = date('i',$datetmp);
    $segundotmp = date('s',$datetmp);
    $fechaModificada = $horatmp.":".$minutotmp.":".$segundotmp;
    $fechaModificada = "".$fechaModificada;
    array_push($DataTime, $fechaModificada);
    array_push($DataValue, $valores["valor"]);
    //array_push($Data, [$fechaModificada , $valores["valor"]] );
    array_push($Data, [$valores["fecha"] , $valores["valor"]] );
    
    $AcumVal = $AcumVal+$valores["valor"];
    if($lastID < $valores["id_monitoreo"]){
        $lastID = $valores["id_monitoreo"];
        $lastVal = $valores["valor"];
        $date = $valores["fecha"];
    }
    $long++;
}

//Trabajando con la ultima fecha
$date = strtotime($date);
$mesText = $months[date('n', $date)-1];
$dia = date('d', $date);
$hora = date('H', $date);
$fechaText = "Dia: ".$mesText."-".$dia." ".$hora."horas";


$DataTime = array_reverse($DataTime);
$DataValue = array_reverse($DataValue);
$Data = array_reverse($Data);

$TiempoMuestraBtn = $long." puntos";
$limitesText = "Limites: ".$LimInf."-".$LimSup;
$valVar = $lastVal - $firstVal;
$valVar = round($valVar,3);
$valVarx100 = ($valVar*100)/$lastVal;
$valVarx100 = round($valVarx100,2);
$valVarx100Text = $valVarx100."%";

if($valVar > 0){
    $varArrow = 1;
} else {
    $varArrow = 0;
}

$valFinal = $lastVal;
$valIni = $firstVal;
if($valFinal > $LimSup or $valFinal < $LimInf){
    $valFace = 1;
} else {
    $valFace = 0;
}

$valMedio = $AcumVal/$long;
$valMedio = round($valMedio,2);



$arr = array('Data'=> $Data, 'DataTime' => $DataTime, 'DataValue' => $DataValue , 'lastID' => $lastID, 'fechaText' => $fechaText, 'TiempoMuestraBtn' => $TiempoMuestraBtn, 'limitesText' => $limitesText, 'varArrow' => $varArrow, 'valVar' => $valVar, 'valVarx100' => $valVarx100Text, 'valFinal' => $valFinal, 'valIni' => $valIni, 'valFace' => $valFace, 'valMax' => $valMax, 'valMin' => $valMin, 'valMedio' => $valMedio, 'long' => $long, 'varLimSup' => $LimSup, 'varLimInf' => $LimInf );

echo json_encode($arr);
//echo json_encode($result);

?>
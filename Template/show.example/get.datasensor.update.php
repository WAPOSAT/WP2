<?php
require_once ("../../require/conexion.class.php");
require_once ("../../require/Block_Sensors.class.php");
require_once ("../../require/Measurement.class.php");
require_once ("../../require/Parameters.class.php");
require_once ("../../require/Blocks.class.php");

$DataTime = array();
$DataValue = array();
$Data = array();
$lastID = 0;
$long = 0;

$Measurement = new Measurement();
$Block_Sensors = new Block_Sensors();
$Parameters = new Parameters();
$Blocks = new Blocks();
$decimal = 2;

// Informacion enviada por GET
$id = (float)$_GET["BS"];
$last = $_GET["last"];
//$id = 2;

//$time = $_GET["time_type"];
/*
    time_type= '24day' --> to show the last 24 hours
    time_type= '1Week' --> to show the last week
    time_type= 'All'   --> to show all the information until now
*/

$Block = $Block_Sensors->getblock_byId ($id);
// verificamos que el Id enviado pertenesca a un Block_Station que este activo
if($Block != 0){

    $ValParameters = $Parameters->getParameter_bySensor ($Block["id_sensor"]);

    $months = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

    $LimSup = (float)$Block["up_danger_limit"];
    $LimInf = (float)$Block["up_risk_limit"];
    $Unit = $ValParameters["code"];
    $Sensor_name = $ValParameters["parameter_codename"];

    $firstVal = 0;
    $lastVal = 0;
    $AcumVal = 0;
    $long =0;

    $Measurement->get_sinceId ($Block["id_sensor"], $last);

    while($valores = $Measurement->retornar_SELECT()){
        
        $datetmp = new DateTime ($valores["date"], new DateTimeZone("UTC"));
        $dateval = $datetmp->getTimestamp()."000";

        $valuetmp = (float)$valores["value"];
        $valuetmp = abs($valuetmp);

        array_push($DataTime, (float)$dateval);
        array_push($DataValue, round($valuetmp, $decimal));
        
        //array_push($Data, [$valores["date"] , (float)$valores["valor"]] );
        
        if($lastID < $valores["id_measurement"]){
            $lastID = (float)$valores["id_measurement"];
            $lastVal = (float)$valores["value"];
            $lastVal = abs($lastVal);
            $lastVal = round($lastVal,$decimal);
            $lastdate = $valores["date"];
        }
        $long++;
    }

    //Trabajando con la ultima fecha
    
    $date = strtotime($lastdate);
    $mesText = $months[date('n', $date)-1];
    $dia = date('d', $date);
    $hora = date('H', $date);
    $minuto = date('i',$date);
    $segundo = date('s',$date);
    $fechaText = "".$mesText."-".$dia." ".$hora.":".$minuto.":".$segundo;

    $DataTime = array_reverse($DataTime);
    $DataValue = array_reverse($DataValue);
    $Data = array_reverse($Data);

    $arr = array(
        'IdBlockSensor'=> $id,
        'SensorName' => $Sensor_name,
        'Data' => [ 
            'Value' => $DataValue ,
            'Date' => $DataTime 
            ],
        'Unit'=>$Unit,
        'Last' => [ 
            'Id' => $lastID,
            'Value'=> $lastVal,
            'Date' => $lastdate
            ],
        'DateText' => $fechaText,
        'Long' => $long,
        'LMP' => $LimSup,
        'LMR' => $LimInf 
    );

    echo json_encode($arr);
}
?>
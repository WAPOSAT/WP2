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

$id = (float)$_GET["BS"];
$time = (float)$_GET["time"];
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
    // Se obtiene los datos adicionales
    $ValParameters = $Parameters->getParameter_bySensor ($Block["id_sensor"]);
    $ValBlock = $Blocks->getblock_byId($Block["id_block"]);
    if($time == 1){
        $Measurement->get_lastmonth ($Block["id_sensor"]);
    } else {
        $Measurement->get_lastweek ($Block["id_sensor"]);    
    }
    

    // Se genera el array para la creacion de data
    $months = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

    $LimSup = (float)$Block["up_danger_limit"];
    $LimInf = (float)$Block["up_risk_limit"];
    $Unit = $ValParameters["code"];
    $Sensor_name = $ValParameters["parameter_codename"];
    

    $firstVal = 0;
    $lastVal = 0;
    $AcumVal = 0;

    while($valores = $Measurement->retornar_SELECT()){
        if ($long == 0){
            $valMax = (float)$valores["value"];
            $valMin = (float)$valores["value"];
        }
        if ($valMax < (float)$valores["value"]){
            $valMax = (float)$valores["value"];
        }
        if ($valMin > (float)$valores["value"]){
            $valMin = (float)$valores["value"];
        }
        $firstVal = (float)$valores["value"];

        $datetmp = new DateTime ($valores["date"], new DateTimeZone("UTC"));
        $dateval = $datetmp->getTimestamp()."000";

        $valuetmp = (float)$valores["value"];

        array_push($DataTime, (float)$dateval);
        array_push($DataValue, round($valuetmp, $decimal));
        
        array_push($Data, [$valores["date"] , (float)$valores["valor"]] );
        
        $AcumVal = $AcumVal+$valores["value"];
        if($lastID < $valores["id_measurement"]){
            $lastID = (float)$valores["id_measurement"];
            $lastVal = (float)$valores["value"];
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

    $info_parameter = utf8_encode($ValParameters["referencia"]);
    //$info_parameter = utf8_encode("hola<div>hola 2</div>");

    $valMedio = $AcumVal/$long;
    $valMedio = round($valMedio,$decimal);

    /*
    if($valMedio > $lastVal && $Block["better_up"] == 0) {
        $message_advice = "Hemos detectado que la ultima medicion es menor que la media, por lo que le recomendamos utilizar el agua en este momento pues se requiere menos insumos para su preparación";
    } else if ($valMedio < $lastVal && $Block["better_up"] == 0) {
        $message_advice = "Hemos detectado que este no es buen momento de usar agua para su proceso, la calidad no es la mejor de acuerdo a las ultimas 24 horas";
    }else {
        $message_advice = "Su agua esta en los valores medios, su utilizacion no tendra mayor repercucion en su proceso";
    }
    */
    /*
    IBM
    -12.071199, -76.952113
    */
    /*
    CITRAR UNI

    $map_zoom  = 16;
    $map_LatCenter = -12.01109;
    $map_LngCenter = -77.050624;
    */

    $arr = array(
        'IdBlockSensor'=> $id,
        'SensorName' => $Sensor_name,
        'Data' => [
            'Value' => $DataValue,
            'Date' => $DataTime
            ],
        'Unit'=>$Unit ,
        'Last' => [
            'Id' => $lastID,
            'Value'=> $lastVal,
            'Date' => $lastdate
            ],
        'DateText' => $fechaText,
        'MaxValue' => $valMax,
        'MinValue' => $valMin,
        'MeanValue' => $valMedio,
        'Long' => $long,
        'LMP' => $LimSup,
        'LMR' => $LimInf,
        'InfoParameter' => $info_parameter
        );

    echo json_encode($arr);
    //echo json_encode($result);
} else {
    // aca en caso se encuentre que el Id es incorrecto
}

?>
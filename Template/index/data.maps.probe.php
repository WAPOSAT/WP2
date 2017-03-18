<?php

$arr = array('pointMarker' => [
    ['id'=>4, 'lat' => 40.6386333, 'lng'=>-8.745,     'name'=>"Estación CITRAR-UNI", 'codename'=>"PMT-1", 'imgpuntero'=>"../img/PointSensor.png"],
    ['id'=>5, 'lat' => 40.59955,   'lng'=>-8.7498167, 'name'=>"Estación Rio Rimac",  'codename'=>"PMT-2", 'imgpuntero'=>"../img/PointSensor.png"],
    ['id'=>6, 'lat' => 40.6247167, 'lng'=>-8.7129167, 'name'=>"Estación Peru Cola",  'codename'=>"PMT-3", 'imgpuntero'=>"../img/PointSensor.png"]
            ],
    'mapOption' => ['zoom'=>13, 'centerPosition' => [40.623813,-8.734692]]
            );

echo json_encode($arr);
?>
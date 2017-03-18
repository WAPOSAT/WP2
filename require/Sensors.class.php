<?php
//require_once ("../require/conexion_class.php");

class Sensors {
    private $_conexion;
    
    public function __construct(){
        $this->_conexion = new conexion();
    }
    
    public function get_sensor ($id_sensor){
        $sql = "SELECT * FROM sensors,sensor_models,measurements_units,parameters WHERE  sensors.id_sensor_model=sensor_models.id_sensor_model AND sensor_models.id_parameter=parameters.id_parameter AND sensor_models.id_measurement_unit=measurements_units.id_measurement_unit AND  sensors.id_sensor=".$id_sensor." ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}

?>

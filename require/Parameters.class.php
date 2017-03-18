<?php
//require_once ("../../require/conexion_class.php");

class Parameters {
    private $_conexion;
    
    public function __construct(){
        $this->_conexion = new conexion();
    }
    
    public function getParameter_bySensor ($id_sensor){
        $sql = "SELECT * FROM measurements_units,parameters,sensors,sensor_models WHERE sensor_models.id_parameter=parameters.id_parameter AND sensors.id_sensor_model=sensor_models.id_sensor_model AND measurements_units.id_measurement_unit=sensor_models.id_measurement_unit AND sensors.id_sensor='".$id_sensor."' LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}

?>

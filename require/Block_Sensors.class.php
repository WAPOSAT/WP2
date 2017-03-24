<?php
//require_once ("../require/conexion_class.php");

class Block_Sensors {
    private $_conexion;
    
    public function __construct(){
        $this->_conexion = new conexion();
    }
    
    public function getblock_byId ($id){
        $sql = "SELECT * FROM block_sensors WHERE active=1 AND id=".$id." LIMIT 1 ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }

    public function getblock_Sensor ($id_block, $id_sensor){
        $sql = "SELECT * FROM block_sensors WHERE active=1 AND id_block=".$id_block." AND id_sensor=".$id_sensor." ";
        $this->_conexion->ejecutar_sentencia($sql);
    }

    public function getSensors_visible ($id_block){
        $sql = "SELECT * FROM block_sensors WHERE active=1 AND visible=1 AND id_block=".$id_block." ";
        $this->_conexion->ejecutar_sentencia($sql);
    }

    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}

?>

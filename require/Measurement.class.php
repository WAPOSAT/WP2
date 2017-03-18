<?php
//require_once ("../require/conexion_class.php");

class Measurement {
    private $_conexion;
    
    public function __construct(){
        $this->_conexion = new conexion();
    }
    
    public function get_day ($id_sensor,$date){
        $sql = "SELECT * FROM measurement WHERE id_sensor=".$id_sensor." AND date BETWEEN '".$date." 00:00:00' AND '".$date." 23:59:59' ORDER BY id_measurement DESC ";
    }

    public function get_range ($id_sensor,$date1,$date2){
        $sql = "SELECT * FROM measurement WHERE id_sensor=".$id_sensor." AND date BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59' ORDER BY id_measurement DESC ";
    }

    public function get_last ($id_sensor){
        $sql = "SELECT * FROM measurement WHERE id_sensor=".$id_sensor." ORDER BY id_measurement DESC LIMIT 1 ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }

    public function get_all ($id_sensor){
        $sql = "SELECT * FROM measurement WHERE id_sensor=".$id_sensor." ORDER BY id_measurement DESC ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function get_lastweek ($id_sensor){
        $sql = "SELECT * FROM `Measurement` WHERE id_sensor=".$id_sensor." AND date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY";
        $this->_conexion->ejecutar_sentencia($sql);
    }

    public function get_24hours ($id_sensor, $date){
        $sql = "SELECT * FROM measurement WHERE id_sensor=".$id_sensor." AND date > DATE_SUB('".$date."', INTERVAL 1 DAY) ORDER BY id_measurement DESC ";
        $this->_conexion->ejecutar_sentencia($sql);
    }

    public function get_last24hours ($id_sensor){
        $last = $this->get_last($id_sensor);
        $this->get_24hours($id_sensor, $last["date"]);    
    }

    public function get_sinceId ($id_sensor, $id_measurement){
        $sql = "SELECT * FROM measurement WHERE id_sensor=".$id_sensor." AND id_measurement>".$id_measurement." ORDER BY id_measurement DESC ";
        $this->_conexion->ejecutar_sentencia($sql);
    }

    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}

?>

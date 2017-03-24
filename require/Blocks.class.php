<?php
//require_once ("../require/conexion_class.php");

class Blocks {
    private $_conexion;
    
    public function __construct(){
        $this->_conexion = new conexion();
    }
    
    public function getblock_byId ($id){
        $sql = "SELECT * FROM blocks WHERE active=1 AND id=".$id." LIMIT 1 ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }

    public function verify_station($id){
        $sql = "SELECT * FROM blocks WHERE active=1 AND id_block_type=3 AND id=".$id." LIMIT 1 ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }

    public function getstation_byId($id){
        if($this->verify_station($id)){
            $this->_conexion->ejecutar_ultima_sentencia();
            return $this->retornar_SELECT();
        } else {
            return 0;
        }
    }

    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}

?>

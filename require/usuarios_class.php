<?php
require_once ("../require/conexion_class.php");

class usuarios {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function verificar_usuario ($usuario,$clave){
        $sql = "SELECT * FROM Usuario WHERE Usuario='".$usuario."' AND Password='".$clave."' AND Activo=1 ";
        $this->_conexion->ejecutar_sentencia($sql);
        $usuario = $this->_conexion->tam_respuesta();
        if($usuario == 1){
            return 1;
        }else {
            return 0;
        }
    }
    
    public function obtener_id_persona ($usuario, $clave){
        if($this->verificar_usuario($usuario, $clave) == 1 ){
            $sql = "SELECT * FROM Usuario WHERE Usuario='".$usuario."' AND Password='".$clave."' AND Activo=1 ";
            $this->_conexion->ejecutar_sentencia($sql);
            $usuario = $this->retornar_SELECT();
            return $usuario["IdUsuario"];
        } else {
            return 0;
        }
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
    
    
}
?>
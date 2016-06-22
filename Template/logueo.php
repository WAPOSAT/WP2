<?php
session_start();
require_once ("../require/usuarios_class.php");


$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

$usuarios = new usuarios ();

$id_persona = $usuarios->obtener_id_persona ($usuario, $clave);
    
if ($id_persona != 0  ){
    
    $_SESSION["id_persona"]=$id_persona;
	echo "<script type='text/javascript'>
			window.location.assign('index.php');
			</script>";
} else {
    echo "<script type='text/javascript'>
			alert('El usuario o la clave son incorrectas, o estan deshabilitados porfavor vuelva a intentarlo o consulte con el administrador');
			window.location.assign('index.php');
			</script>";
}

?>

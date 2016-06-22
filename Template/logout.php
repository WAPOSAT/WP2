<?php 
session_start();
	unset($_SESSION["id_persona"]);
session_destroy();
	header("Location: index.php");
?>
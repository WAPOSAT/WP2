<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
if($id_persona) {
    
/* ....................................................................... */
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>WAPOSAT</title>
    
    <?php  include_once("../include/head.default.php");?>
    
    <!-- Especific CSS -->
    <link href="monitoreo/style.monitoreo.css" rel="stylesheet">
    
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    
    <!-- Especific JS -->
    <?php  //include_once("monitoreo/maps.scriptJS.php"); ?>
    <script src="../js/Chart.js"></script>
    <script src="DemostrationLAN/DemostrationLAN.js"></script>
    <!-- <script src="monitoreo/GenericChart.js"></script> -->
    <script src="monitoreo/CuadroMonitoreo.js"></script>
    <script>
        window.onload = function(){
           CargarCuadroGraficas ();
        }
    </script>
    
</head>

<body>
    
    <!-- Navigation -->
    <?php include_once("../include/navbar.default.php"); ?>
    
    <!-- Body -->
    <div class="tab-content">
        <!-- Container -->
        <div id="container" class="col-xs-12 col-md-12">
            <div id="information"  >
                
            </div> <!-- information -->
        </div> <!-- /Container -->
    </div> <!-- /Body -->
    
    <!-- Footer -->
    <?php include_once("../include/footer.default.php"); ?>
    
    
</body>
    
</html> 

<?php 
/* ...................................................................... */	

} else {

?>
    
<html>
	<head>
	<title>WAPOSAT</title>
    
    <?php include_once("../include/head.default.php"); ?>    
    
    <!-- Especific   -->
	<link href="index/index.css" type="text/css" rel="stylesheet" >
	<script type="text/javascript" language="javascript" src="index/index.js" ></script>
    <script src="../js/sb-admin-2.js"></script>
    <script type="text/javascript" language="javascript" src="../js/metisMenu.min.js" ></script>    
        
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../css/metisMenu.min.css" type="text/css" rel="stylesheet" >
        
	</head>
	<body>
		
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card " src="../img/logos/gota-waposat.png" />
                <p id="profile-name" class="profile-name-card"></p>
                <form class="form-signin" action="logueo.php" name="form" method="post" >
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Correo electr&oacute;nico" name="usuario" required autofocus>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Contrase&ntilde;a" name="clave" required >
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Ingresar</button>
                </form><!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
        
	</body>
</html>

<?php   
}

?>
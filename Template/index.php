<!DOCTYPE html>
<html lang="es" >
  <head>
    <title>Monitoreo</title>

    <!-- Including general head -->
    <?php  include_once("../include/head.general.php");?>

    <!--Estilos-->
    <link rel="stylesheet" type="text/css" href="index/style.index.css">
          
  </head>
  <body >
    <div id="o-wrapper" class="o-wrapper">
            <div class=Login>
                <img src="../img/waposat-logo.png">
                <form id="formulario" action="{{ path('login') }}" method="post">
                <div class="BoxLogin" ><i class="fa fa-user" aria-hidden="true"></i><input id="username" name="_username"  type="text" placeholder="Usuario"></div>
                <div class="BoxLogin" ><i class="fa fa-lock " aria-hidden="true"></i><input id="password" type="password" name="_password" placeholder="Contraseña"></div>
                <div class=Recordar>
                     <label><input type="radio" name="_target_path" value="alert" checked=""> Alertas</label>
                     <label><input type="radio" name="_target_path" value="scada"> Scada</label><br>
                <!--
                    <label><input type=checkbox value=1 name=recordar> Recordar Contraseña</label>
                -->
                </div>

                <input  type="submit" class=ButtonEnter onclick=Login() value="Ingresar">

                </form>
            </div>
            <div class=LoginInfo>Olvide mi contraseña &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Necesito una cuenta
                <div class=Respuesta id="respuesta">
                    
                </div>
            </div>
        </div>
     

  </body>
</html>
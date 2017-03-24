<?php
  $id = $_GET["ID"];
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Monitoreo</title>
    
  <!-- Including general head -->
  <?php  include_once("../include/head.general.php");?>
  <!-- Especific CSS -->
  <link rel="stylesheet" type="text/css" href="index/style.index.css">
  <!-- Especific JS -->
  <script src="../js/stock/highstock.js"></script>
  <script src="../js/stock/modules/exporting.js"></script>
  <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBLnlAQH441DxvN2xRinRYC3hyQ_5BGJGE" async="" defer="defer" type="text/javascript"></script>
  

</head>
<body onload="print_datasensor()">
  
  <div id="header" class="col-md-12" >
  <!-- Navigation -->
    <?php include_once("../include/navbar.general.php"); ?>  
  </div>

  <!--   -->
  <div id="myCarousel" class="col-md-12 carousel slide" >   <!-- data-ride="carousel"  -->
    <ol class="carousel-indicators" >
      <li data-target="#myCarousel" style="background-color: #4DB4DE" data-slide-to="0" class="active" ></li>
      <li data-target="#myCarousel" style="background-color: #1D648E" data-slide-to="1" ></li>
    </ol>
    <div class="carousel-inner" > <!-- role="listbox" -->
      

    <!--  Primera Vista -->
      <div class="item active">
        <div id="screen-1" class="col-md-12" style="height: 400px; min-width: 310px">
          <div class="col-md-12 text-center parameter-info">
            <strong id="parameter-name-1" ></strong> <button id="parameter-state-1" type="button" class="btn btn-success"></button>
          </div>
          <div id="last-sensor-value-1" class="col-md-12 text-center"> 
          </div>
          <div id="last-measure-date" class="col-md-12 text-center" ></div>
        </div>
        <div  class="col-md-12" style="height: 50px; min-width: 310px"></div>
      </div>
      <!-- Fin Primera Vista -->

      <!--  Segunda Vista -->
      <div class="item">
        <div id="screen-2" class="col-md-12" style="height: 400px; min-width: 310px">
          <div class="col-md-12 text-center parameter-info">
            <div id="last-sensor-value-2" class="col-md-12 text-center">
            </div> 
          </div>
          <div class="col-md-12 text-center" >
            
            <div class="col-md-offset-2 col-xs-12 ">
              <div id="container" class="col-md-8" style="height: 300px; " ></div>  
            </div>
          </div>
        </div>
        <div class="col-md-12" style="height: 50px; min-width: 310px"></div>
      </div>
      <!-- Fin Segunda Vista -->
    </div>
    <!-- Fin de las Vistas -->

    <!-- Botones laterales -->      
    <a class="left carousel-control" href="#" onclick="$('#myCarousel').carousel('prev')">
      <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#" onclick="$('#myCarousel').carousel('next')">
      <span class="icon-next"></span>
    </a>
    <!-- Fin de Botones laterales -->

  </div>

  

  <!-- Footer -->
  <?php include_once("../include/footer.general.php"); ?>

  <script type="text/javascript">
    // Configuracion del tiempo de cambio en el slide
    /*$('.carousel').carousel({
      interval: 1000 * 15
    });
    */
    // obteniendo la varible GET
    var ID_BS = <?php echo $id ?>;

  </script>

  <script type="text/javascript" src="index/maps.singleMark.js"></script>
  <script type="text/javascript" src="show.parameter/print.datasensor.update.js"></script>
  <script type="text/javascript" src="show.parameter/print.datasensor.js"></script>

</body>
</html>

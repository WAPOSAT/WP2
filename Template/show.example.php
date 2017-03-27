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

<body onload="create_framestations()">

  <div id="header" class="col-md-12" >
  <!-- Navigation -->
    <?php include_once("../include/navbar.general.php"); ?>  
  </div>

  <!--   -->
  <div id="myCarousel" class="col-md-12 carousel slide" >   <!-- data-ride="carousel"  -->
    <ol class="carousel-indicators" >
      <li data-target="#myCarousel" style="background-color: #4DB4DE" data-slide-to="0" ></li>
      <li data-target="#myCarousel" style="background-color: #1D648E" data-slide-to="1" ></li>
      <li data-target="#myCarousel" style="background-color: #5BB598" data-slide-to="2" ></li>
      <li data-target="#myCarousel" style="background-color: #ABD099" data-slide-to="3" ></li>
    </ol>
    <div class="carousel-inner" > <!-- role="listbox" -->
      

    <!--  Primera Vista -->
      <div class="item">
        <div id="screen-1" class="col-md-12" style="height: 340px; min-width: 310px">
          
        </div>
        <div  class="col-md-12" style="height: 50px; min-width: 310px"></div>
      </div>
      <!-- Fin Primera Vista -->

      <!--  Segunda Vista -->
      <div class="item">
        <div id="screen-2" class="col-md-12" style="height: 340px; min-width: 310px">
          
        </div>
        <div class="col-md-12" style="height: 50px; min-width: 310px"></div>
      </div>
      <!-- Fin Segunda Vista -->

      <!--  Tercera Vista -->
      <div class="item">
        <div id="screen-3" class="col-md-12" style="height: 340px; min-width: 310px">
          
        </div>
        <div class="col-md-12" style="height: 50px; min-width: 310px"></div>
      </div>
      <!-- Fin Tercera Vista -->

      <!--  Quinta Vista -->
      <div class="item active">
        <div id="screen-5" class="col-md-12" style="height: 340px; min-width: 310px">          
          <div id="map-slide" class="col-md-12" style="height: 400px " >
            
          </div>
        </div>
        <div id="footer-screen-5" class="col-md-12" style="height: 50px; min-width: 310px"></div>        
      </div>
      <!-- Fin Quinta Vista -->

      <!-- Fin de las Vistas -->


    </div>

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
    $('.carousel').carousel({
      interval: 1000 * 15
    });

    // obteniendo la varible GET
    var IdS = <?php echo $id ?>;

  </script>
  <script type="text/javascript" src="show.example/print.datasensors.js"></script>
  <script type="text/javascript" src="show.example/create.framestations.js"></script>
  <script type="text/javascript" src="show.example/maps.singleMark.js">
  </script>
  <script type="text/javascript" src="index/print.datasensor.update.js"></script>
  

</body>
</html>
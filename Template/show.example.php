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
      <li data-target="#myCarousel" style="background-color: #5BB598" data-slide-to="2" ></li>
      <li data-target="#myCarousel" style="background-color: #ABD099" data-slide-to="3" ></li>
      <li data-target="#myCarousel" style="background-color: #4DB4DE" data-slide-to="4" ></li>
    </ol>
    <div class="carousel-inner" > <!-- role="listbox" -->
      

    <!--  Primera Vista -->
      <div class="item">
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

      <!--  Tercera Vista -->
      <div class="item">
        <div id="screen-3" class="col-md-12" style="height: 400px; min-width: 310px">
          <div class="col-md-12 text-center parameter-info">
            <strong id="parameter-name-3" ></strong>=<strong id="last-sensor-value-3" ></strong> <button id="parameter-state-3" type="button" class="btn btn-success"></button>
          </div>
          <div id="parameter-teory" class="col-md-10 col-md-offset-1 col-xs-12">
            
            <!-- Contenido de la tercera vista -->
            
            <!-- Fin del contenido de la tercera vista -->


          </div>
          
        </div>
        <div class="col-md-12" style="height: 50px; min-width: 310px"></div>
      </div>
      <!-- Fin Tercera Vista -->

      <!--  Cuarta Vista -->
      <div class="item">
        <div id="screen-4" class="col-md-12" style=" min-width: 310px">
          <!-- 
          <div class="col-md-12 text-center parameter-info">
            <strong id="parameter-name-4" ></strong> <button id="parameter-state-4" type="button" class="btn btn-success"></button>
          </div>
          -->
          <div style="height: 30px" class="col-md-12" ></div>
          <div id="body-4" style="background-color: #ffffff;" class="col-md-12"   >
            
            <div class="col-md-8  col-xs-12 ">
              <div id="container2" style="height: 350px" ></div>  
            </div>
            <div  class="col-md-4 col-xs-12 text-justify" >
              <div style="background-color: #ffffff; height: 300px;" class="col-md-10 col-xs-12" >
                <br>
                <p id="advice"></p>
                <strong>Ultimo Valor: </strong><div id="last-sensor-value-4" class="col-md-12 text-center"></div>
              </div>
              <!--
              <div class="col-md-7 col-xs-5 text-center">
                <p id="max-value"></p>
                <p id="mean-value"></p>
                <p id="min-value"></p>
                <p id="last-value"></p>
              </div>
              -->
            </div>
          </div>
        </div>
        <div id="footer-screen-4" class="col-md-12" style="height: 50px; min-width: 310px"></div>
        

      </div>
      <!-- Fin Cuarta Vista -->

      <!--  Quinta Vista -->
      <div class="item active ">
        <div id="screen-5" class="col-md-12" style="height: 400px; min-width: 310px">          
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
    var slide = 1;
    /*
    $(".carousel").on('slid.bs.carousel', function(e){
        slide++;
        if(slide==5){
          console.log("cargar mapa...");
          google.maps.event.trigger(map,'resize');
        }
      }
    );*/
    // obteniendo la varible GET
    var ID_BS = <?php echo $id ?>;

  </script>

  <script type="text/javascript" src="index/maps.singleMark.js"></script>
  <script type="text/javascript" src="index/print.datasensor.update.js"></script>
  <script type="text/javascript" src="index/print.datasensor.js"></script>

</body>
</html>
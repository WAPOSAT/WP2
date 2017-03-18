<!DOCTYPE html>
<html lang="es">

<head>
    <title>Monitoreo</title>
    
    <!-- Including general head -->
    <?php  include_once("../include/head.general.php");?>
    <!-- Especific CSS -->
    <link href="index/style.index.css" rel="stylesheet">
    
    <!-- Especific JS -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="showdate/charge.values.date.js"></script>
    <script src="showperiod/static.monitoring.js"></script>
    <script>
        // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['line', 'corechart']});

    </script>
    
</head>


<body>
    
    <!-- Navigation -->
    <?php include_once("../include/navbar.general.php"); ?>
    
    <!-- Body -->
    <div>
        <div class="col-xs-12 col-md-4">
            <input type="text" id="Station" value="20">
        </div>
        <div class="col-xs-12 col-md-4">
            <input type="date" id="Date1" value="2016-07-15">
        </div>
        <div class="col-xs-12 col-md-4">
            <button onclick="chargeValuesDate()">Ver</button>
        </div>
    </div>
    <div class="tab-content">
        <!-- Container -->
        <div id="container" class="col-xs-12 col-md-12">
            <div id="information"  >
                
            </div> <!-- information -->
        </div> <!-- /Container -->
    </div> <!-- /Body -->
    
    <!-- Footer -->
    <?php include_once("../include/footer.general.php"); ?>
    
    
</body>
    
</html> 
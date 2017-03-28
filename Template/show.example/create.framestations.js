/* Esta funcion es utilizada para generar los cuadros en todo el 
esqueleto de los parametros para luego desplegar la informacion
*/
var Station;

function create_framestations() {
	$.ajaxSetup({ cache:false });

	$.getJSON('show.example/get.datastation.php?IdS='+IdS, function(data) {
	  Station = data;
	  data = null;
	  // creamos el contenedor de cada screen
	  var s1_content = "";
	  var s2_content = "";
	  var s3_content = "";
	  
	  // analizando la distribucion de los cuadros
	  var cuadros = Station.sensores.length;
	  if (cuadros<=3){
	  	var numUp = 12/cuadros;
	  	var numDown = 12;
	  } else if(cuadros==4){
	  	var numUp = 6;
	  	var numDown = 6;
	  } else if (cuadros>4){
	  	var numUp = 4;
	  	var numDown = 12/(cuadros-3);
	  }

	  $.each(Station.sensores, function(k, v) {

		

	  	if (k<=4){
	  		var col=numUp;
	  	}	else {
	  		var col=numDown;
	  	}


	  	// Generamos el contenido de la vista 1
      s1_content+="<div id='screen-1-"+v+"' class='col-md-"+col+" col-sm-"+col+" col-lg-"+col+"col-xs-"+col+"'>\n\
      	<div class='col-md-12 text-center parameter-info'>\n\
      	<strong id='parameter-name-1-"+v+"' ></strong><button id='parameter-state-1-"+v+"' type='button' class='btn btn-success'></button>\n\
        </div>\n\
        <div id='last-sensor-value-1-"+v+"' class='col-md-12 text-center last-sensor-value-1'>2.45 NTU\n\
        </div>\n\
        <div id='last-measure-date-"+v+"' class='col-md-12 text-center last-measure-date' >Ultima medicion asdfadf</div>\n\
        </div>";
        
      // Generamos el contenedor de la vista 2
      s2_content+="<div id='screen-2-"+v+"' class='col-md-"+col+" col-sm-"+col+" col-lg-"+col+"col-xs-"+col+"' style='height: 400px;' >\n\
					<div class='col-md-12 text-center parameter-info'>\n\
		        <div id='last-sensor-value-2-"+v+"' class='col-md-12 text-center'>\n\
		        hola"+v+"\n\
		        </div>\n\
		      </div>\n\
	        	<div id='container-"+v+"' style='height: 300px; weight: 100%'></div>\n\
        </div>";    

      // Generamos el contenedor de la vista 3
      s3_content+="<div id='screen-3-"+v+"' class='col-md-"+col+" col-sm-"+col+" col-lg-"+col+"col-xs-"+col+"'>\n\
	        <div class='col-md-12 text-center parameter-info'>\n\
	        	<strong id='parameter-name-3-"+v+"' ></strong>=<strong id='last-sensor-value-3-"+v+"' ></strong> <button id='parameter-state-3-"+v+"' type='button' class='btn btn-success'></button>\n\
	        </div>\n\
	        <div id='parameter-teory-"+v+"' class='col-md-10 col-md-offset-1 col-xs-12'>\n\
	        </div>\n\
        </div>";

/*-------------------------------------------*/
/*  // Analisando la informacion obtenida
   var state="parameter-info last-sensor-value-1 last-measure-date";
 
    if(v==2){
      state1="parameter-info last-sensor-value-1 last-measure-date";
   
    }else if(v==3 && v==4){
      state2="btn btn-danger btn-lg";
     
    }else if(v==5 && v==6){
      state3="btn btn-danger btn-lg";
     
    }

    // Cambiando la informacion general

      $("#parameter-name-1-"+v).removeClass();
      $("#parameter-name-1-"+v).addClass(state1);

 	  $("#parameter-name-1-"+v).removeClass();
      $("#parameter-name-1-"+v).addClass(state2);

      $("#parameter-name-1-"+v).removeClass();
      $("#parameter-name-1-"+v).addClass(state3);

/*.parameter-info{
  
	font-size: 3em;
}

.last-sensor-value-1{

	font-size: 3.8em;
	font-weight: bold; 
}

.last-measure-date{
	font-size: 1em;
	color: #1D648E;
}*/

/*
/*----------------------------------------------*/

    });

	  $("#screen-1").html(s1_content);
	  $("#screen-2").html(s2_content);
	  $("#screen-3").html(s3_content);
    
 print_datasensors();

	});
	  // Punto de modificacion Juan
 
  


	
}

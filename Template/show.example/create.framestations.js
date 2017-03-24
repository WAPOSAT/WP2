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
      s1_content+="<div id='screen-1-"+v+"' class='col-md-"+col+"'>\n\
      	<div class='col-md-12 text-center parameter-info'>\n\
      	<strong id='parameter-name-1-"+v+"' ></strong>hola"+v+" <button id='parameter-state-1-"+v+"' type='button' class='btn btn-success'>NORMAL</button>\n\
        </div>\n\
        <div id='last-sensor-value-1-"+v+"' class='col-md-12 text-center last-sensor-value-1'>2.45 NTU\n\
        </div>\n\
        <div id='last-measure-date-"+v+"' class='col-md-12 text-center last-measure-date' >Ultima medicion asdfadf</div>\n\
        </div>";
        
      // Generamos el contenedor de la vista 2
      s2_content+="<div id='screen-2-"+v+"' class='col-md-"+col+"' >\n\
					<div class='col-md-12 text-center parameter-info'>\n\
		        <div id='last-sensor-value-2-"+v+"' class='col-md-12 text-center'>\n\
		        hola"+v+"\n\
		        </div>\n\
		      </div>\n\
		      <div class='col-md-12 text-center' >\n\
		        <div class='col-md-offset-2 col-xs-12'>\n\
		        	<div id='container-"+v+"' class='col-md-8' style='height: 300px' >Hola</div>\n\
		        </div>\n\
	        </div>\n\
        </div>";      

      // Generamos el contenedor de la vista 3
      s3_content+="<div id='screen-3-"+v+"' class='col-md-"+col+"'>\n\
	        <div class='col-md-12 text-center parameter-info'>\n\
	        	<strong id='parameter-name-3-"+v+"' ></strong>=<strong id='last-sensor-value-3-"+v+"' ></strong> <button id='parameter-state-3-"+v+"' type='button' class='btn btn-success'></button>\n\
	        </div>\n\
	        <div id='parameter-teory-"+v+"' class='col-md-10 col-md-offset-1 col-xs-12'>\n\
	        	Hola mundo\n\
	        </div>\n\
        </div>";

    });

	  $("#screen-1").html(s1_content);
	  $("#screen-2").html(s2_content);
	  $("#screen-3").html(s3_content);

	  









	  // Punto de modificacion Juan

	  





	    
	});
}
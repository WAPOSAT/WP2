// Esta parte es activada desde print.datasensor.js

function print_datasensors_update (){
	//console.log("Cargando nueva data");
	cont++;
	if(cont==150){
		location.reload();
	}

	$.each(generalChart, function(k, v) {
		// Solicitando los ultimos datos del sensor
		$.getJSON('show.example/get.datasensor.update.php?BS='+v.id+'&last='+v.lastId, function (data) {

			if(data.Long>0){
				
				// Analisando la informacion obtenida
		    var state="btn btn-success btn-lg";
		    var content_state = "NORMAL"
		    var state_color = "#449d44";
		    if(data.Last.Value>=data.LMR && data.Last.Value<=data.LMP){
		      state="btn btn-warning btn-lg";
		      content_state = "CUIDADO";
		      state_color = "#ec971f";
		    }else if(data.Last.Value>data.LMP){
		      state="btn btn-danger btn-lg";
		      content_state = "PELIGRO!!";
		      state_color = "#c9302c";
		    }

		    // Cambiando la informacion general
		    for(var a=1; a<=slides; a++){
		      $("#parameter-name-"+a+"-"+v.id).html(data.SensorName);
	        $("#parameter-state-"+a+"-"+v.id).removeClass();
	        $("#parameter-state-"+a+"-"+v.id).addClass(state);
	        $("#parameter-state-"+a+"-"+v.id).html(content_state);

	        $("#last-sensor-value-"+a+"-"+v.id).html(data.Last.Value+' '+data.Unit);
		    }

		    // SCREEN 1
	    	$("#last-measure-date-"+v.id).html("Ultima medición: "+data.DateText);

	    	// SCREEN 2

	    	// Cargando nuevos valores en las graficas
				for (var a=0;a<data.Data.Value.length ;a++){
		      
		      //Si data.Data.Date[a] se recibe como un texto del tipo '2016-03-11 11:00:00' usar lo siguiente
		      //var d = new Date(data.Data.Date[a]).getTime();
		      //generalChart.series[0].addPoint([d,data.Data.Value[a]],true,true);
		      //adviceChart.series[0].addPoint([d,data.Data.Value[a]],true,true);

		      //Si data.Data.Date[a] se recibe como el valor Unix  se puede utilizar asi
					v.chart.series[0].addPoint([data.Data.Date[a],data.Data.Value[a]],true);

		    }

		    // actualizando el lastId del sensor
	      generalChart[k].lastId = data.Last.Id;
				
				data = null;	
			}
		});

	});
	
}
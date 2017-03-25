// Objeto que contendran las graficas en array
var generalChart=[];

// Variables para el ciclo de actualizacion
var actualizarSensor=[];
var Sensor = [];

// Se crea como variable global para poder visualizarla en la consola
var Data = [];
var slides = 5;
// si esta en 1 cuando el tamaño de la pantalla es menor a min_width y se deben considerar unos cambios
var responsive = 0;
// variable para controlar generalChart rangeSelector
var rangeSelector = 0;


function print_datasensors() {
  //analyse_width();
  $.each(Station.sensores, function(k, v) {

    $.getJSON('show.example/get.datasensor.php?BS='+v, function (data) {
      
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
        $("#parameter-name-"+a+"-"+v).html(data.SensorName);
        $("#parameter-state-"+a+"-"+v).removeClass();
        $("#parameter-state-"+a+"-"+v).addClass(state);
        $("#parameter-state-"+a+"-"+v).html(content_state);

        $("#last-sensor-value-"+a+"-"+v).html(data.Last.Value+' '+data.Unit);
      }

      // SCREEN 1
      $("#last-measure-date-"+v).html("Ultima medición: "+data.DateText);

      data = null;
    });
  });
}

$( window ).resize(function() {
  analyse_width();
});

// Lista de animaciones encontradas para los efectos
function parpadear(){ $('#last-sensor-value-1').fadeIn(1000).delay(50).fadeOut(1000, parpadear) };

function changeSize(){
  if(responsive==0){
    var size_val = 10;
  } else {
    var size_val = 6;
  }
  
  $("#last-sensor-value-1").animate({fontSize:(size_val)+"em"}).delay(1000);
  $("#last-sensor-value-1").animate({fontSize:(size_val-1)+"em"});
  setTimeout(changeSize, 5000);
};

// Analiza el tamano de la pantalla del browser y configura la variable responsive de acuerdo a eso
function analyse_width(){
  var screen_width;
  var min_width = 830;
  // obtiene el tamanio de la pantalla
  screen_width = $( window ).width();

  if(screen_width<= min_width ){
    responsive = 1;
  } else {
    responsive = 0;
  }
}

function nextRange (){
  generalChart.rangeSelector.clickButton(rangeSelector,2,true);
  if(rangeSelector >=3){
    rangeSelector=0;
  } else {
    rangeSelector++;
  }
}
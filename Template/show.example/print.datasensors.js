// Objeto que contendran las graficas en array
var generalChart=[];

// Variables para el ciclo de actualizacion
var actualizar=null;
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

      // SCREEN 2
      Data = [];
      for (var a=0;a<data.Data.Value.length ;a++){

        //Si data.Data.Date[a] se recibe como un texto del tipo '2016-03-11 11:00:00' usar lo siguiente
        //var d = new Date(data.Data.Date[a]).getTime();
        //Data.push([d, data.Data.Value[a]]);
        
        //Si data.Data.Date[a] se recibe como el valor Unix  se puede utilizar asi
        Data.push([data.Data.Date[a], data.Data.Value[a]]);
      }

      // Estableciendo opciones para la visualizacion de la grafica con Limites Maximos permitidos
      var OptionChart = {
        /*
        chart: {
          type: 'spline',
          events : {
            load : function () {
              setInterval(function () {
                nextRange ();
              }, 3000);
            }
          }
        },
        */
        rangeSelector: {
          selected: 1,
          buttons: [{
            type: 'minute',
            count: 10,
            text: '10m'},
          {
            type: 'hour',
            count: 1,
            text: '1h'},
          {
            type: 'hour',
            count: 8,
            text: '8h'},
          {
            type: 'all',
            text: 'All'}],
          //inputEnabled: false,
        },

        

        title: {
            text: data.Unit+" vs Tiempo"
        },

        yAxis: {
            title: {
                text: "Nivel de "+ data.SensorName
            },
            plotLines: [{
                value: data.LMR,
                color: '#ec971f', // orange
                dashStyle: 'shortdash',
                width: 2,
                label: {
                    text: 'Limite de Riesgo'
                }
            }, {
                value: data.LMP,
                color: '#c9302c', // red
                dashStyle: 'shortdash',
                width: 2,
                label: {
                    text: 'Limite de Peligro'
                }
            }]
        },

        credits: {
            position: {
                align: 'center',
                verticalAlign: 'bottom'
            }
        },

        //colors: ['#086165'],

        series: [{
            name: data.SensorName,
            data: Data,
            lineWidth: 3,
            marker: { radius: 4 },
            zones: [{
              value: data.LMR,
              // Color under data.LMR
              color: '#086165'
            }, {
              value: data.LMP,
              // Color under data.LMP
              color: '#ec971f'
            }, {
              // Color over data.LMP
              color: '#c9302c'
            }],
            tooltip: {
                valueDecimals: 2
            }
        }]
      };

      var sensorChart = Highcharts.stockChart('container-'+v, OptionChart);
            
      // SCREEN 3
      $("#parameter-teory-"+v).html(data.InfoParameter);


      // se guarda la informacion actual en generalChart para que pueda ser
      // utilizada en las actualizaciones de informacion
      generalChart.push({id: v, data: Data, chart: sensorChart, reload: actualizar, lastId: data.Last.Id }); 

      data = null;
    });
  });

  // SCREEN 5
  // Se llama a los datos del mapa desde la variable Station, pues es un
  // valor global del BlockStation
  LoadMapMark (Station.Map);

  // Se llama a la funcion que actualizara permanentemente la informacion del monitoreo
  clearInterval(actualizar);
  //actualizar=setInterval('print_datasensors_update()', (Station.RefreshFrequencySeg*1000));
  actualizar=setInterval('print_datasensors_update()', (10*1000));

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
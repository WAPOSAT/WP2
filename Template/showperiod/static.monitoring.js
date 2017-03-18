var fechaText,
    TiempoMuestraBtn,
    limitesText,
    unidMedida,
    varArrow,
    valVar,
    valVarx100,
    valFinal,
    valIni,
    varLimSup=0,
    varLimInf=0,
    valFace,
    valMax,
    valMedio,
    longData = 0,
    valMin,
    ArrayData;

function ActualizarInformacion(){
    $("#fecha-text").html(fechaText);
    $("#TiempoMuestraBtn").html(TiempoMuestraBtn);
    $("#limites-text").html(limitesText);
    $("#var-lim-sup").html(varLimSup);
    $("#var-lim-inf").html(varLimInf);
    $("#unid-medida-sup").html(unidMedida);
    $("#unid-medida-inf").html(unidMedida);
    $("#val-var").html(valVar);
    $("#val-varx100").html(valVarx100);
    $("#val-final").html(valFinal);
    $("#val-ini").html(valIni);
    $("#val-max").html(valMax);
    $("#val-medio").html(valMedio);
    $("#val-min").html(valMin);
    // Cambiando las figuras
    
    if (varArrow == 1){
        $( "#var-arrow-down" ).hide();
        $( "#var-arrow-up" ).show();
    } else {
        $( "#var-arrow-up" ).hide();
        $( "#var-arrow-down" ).show();
    }
    
    $( "#face-cuadro" ).removeClass("btn-success btn-danger");
    
    if (valFace == 0){
        $( "#val-face-bad" ).hide();
        $( "#val-face-good" ).show();
        $( "#face-cuadro" ).addClass("btn-success");
    } else {
        $( "#val-face-good" ).hide();
        $( "#val-face-bad" ).show();
        $( "#face-cuadro" ).addClass("btn-danger");
    }
    
    $( "#extremos-cuadro" ).removeClass("btn-success btn-danger");
    
    if (valMax < varLimSup && valMin > varLimInf){
        $( "#extremos-cuadro" ).addClass("btn-success");
    } else {
        $( "#extremos-cuadro" ).addClass("btn-danger");
    }
        
}

var ArrayDataTime = {};

function GenerarGrafica (id_equipo, id_parametro, date_beging, date_end){
    
    // Programa Ajax para pedir DataTime
    $parametros = {
        'boton-obtener-data-tiempo' : true,
        'id_equipo' : id_equipo,
        'id_parametro' : id_parametro,
        'date_beging' : date_beging,
        'date_end' : date_end
    };
        
    $url = "showperiod/chart.DataTime.php";
    $.ajax({
        type: "POST",
        url: $url,
        data: $parametros,
        dataType : "json",
        success: function(data){
            
            ArrayDataTime = data;
            ArrayData = ArrayDataTime.Data;
            ArrayNewDataTime = ArrayDataTime.DataTime;
            ArrayNewValues = ArrayDataTime.DataValue;
            varLimSup = ArrayDataTime.varLimSup,
            varLimInf = ArrayDataTime.varLimInf,
            lastID = ArrayDataTime.lastID;
            fechaText = ArrayDataTime.fechaText;
            TiempoMuestraBtn = ArrayDataTime.TiempoMuestraBtn;
            limitesText = ArrayDataTime.limitesText;
            varArrow = ArrayDataTime.varArrow;
            valVar = ArrayDataTime.valVar;
            valVarx100 = ArrayDataTime.valVarx100;
            valFinal = ArrayDataTime.valFinal;
            valIni = ArrayDataTime.valIni;
            valFace = ArrayDataTime.valFace;
            valMax = ArrayDataTime.valMax;
            valMedio = ArrayDataTime.valMedio;
            valMin = ArrayDataTime.valMin;
            longData = ArrayDataTime.long;
            lastID = ArrayDataTime.lastID;
            ActualizarInformacion();
            
            
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Day');
            data.addColumn('number', '');

            for (var i=0; i<ArrayData.length; i++){
                    x = new Date(ArrayData[i][0]);
                    y = parseFloat(ArrayData[i][1]);
                    data.addRows([[x,y]]);
            }
            
            var options = {
            width: 1000,
            height: 300
            };

            var chart = new google.charts.Line(document.getElementById('myChart'));

            chart.draw(data, options);
            
            
        }
    });
}
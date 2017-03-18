function chargeValuesDate () {
    $parametros = {
            'boton-llamar-cuadro-Graficas' : true,
            'id_equipo' : $("#Station").val(),
            'Date1' : document.getElementById("Date1").value,
            'Date2' : document.getElementById("Date1").value,
        };
    $url = "showperiod/static.monitoring.screen.php";
    $.ajax({
        type: "POST",
        url: $url,
        data: $parametros,
        success: function(data){
            $("#information").html(data);
        }
    });
}
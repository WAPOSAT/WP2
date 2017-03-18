<script>
    /*
    En las siguientes funciones se ha trabajado el cargado de los datos de las estaciones utilizando Ajax y JSON
    cargarDatosMapa -> utiliza Ajax para conectarse a otro archivo php el cual debe generar la informacion de las estaciones y pasarsela por JSON, esta informacion es guardada en la variable ArrayDataTimer, posteriormente se carga la informacion en las otras variables que son necesarias para configurar las condiciones del GoogleMaps y de los Markers (Estaciones).
    cargarMapaEstaciones -> utiliza la informacion obtenida en cargarDatosMapa para generar el mapa con la API de Google, es necesario ejecutar esta fucion solo si la peticion Ajax es exitosa, pues de lo contrario no tendria informacion con la cual trabajar.
    */
    
    // Creando variables globales para la data del mapa y estaciones
    var ArrayDataTime = {},
        pointMarker = {},
        mapOptions = {};
    
	function cargarMapaEstaciones (){
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions );

        var infowindow = new google.maps.InfoWindow();

        var marker, i;
        
        // Cargando todos los Markers
        for (i = 0; i < pointMarker.length; i++) { 
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(pointMarker[i].lat, pointMarker[i].lng),
                icon: pointMarker[i].imgpuntero,
                title: pointMarker[i].codename,
                map: map,
                animation: google.maps.Animation.DROP  
            });

            //Configurando los eventos de los Markers 
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(pointMarker[i].name);
                    infowindow.open(map, marker);
                    $( "#map-canvas" ).removeClass( "col-md-12" ).addClass( "col-md-6" );
                    $( "#container" ).removeClass( "col-md-12" ).addClass( "col-md-6" );
                    //map.setCenter(marker.getPosition());
                    AnimationState = 0;
                    CargarCuadroGraficas (pointMarker[i].id);
                    
                }
            })(marker, i));
        }
    }
    
    function cargarDatosMapa (){
        // Programa Ajax para pedir Data del Mapa
        $parametros = {
                'boton-obtener-data-mapa' : true,
            };

        $url = "index/data.maps.PM.php";
        $.ajax({
            type: "POST",
            url: $url,
            data: $parametros,
            dataType : "json",
            success: function(data){
                ArrayData = data;
                pointMarker = ArrayData.pointMarker;
                mapOptions = {
                  zoom: ArrayData.mapOption.zoom,
                  center: new google.maps.LatLng(ArrayData.mapOption.centerPosition[0],ArrayData.mapOption.centerPosition[1]),
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                
                cargarMapaEstaciones ();   
            }
        });
    }
    
    window.onload = function(){
        cargarDatosMapa ();
    }
    
</script>
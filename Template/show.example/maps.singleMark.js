
/*
	LoadMapMark (map)
	Muestra la vista de Google Maps con un marcador de la geolocalizacion de la estacion
	Parametros:
		mapa -> es un objeto que contiene la informacion de la geolocalizacion del punto
*/

var marker;
var map;

function LoadMapMark (mapa){
	mapOptions = {
    zoom: mapa.Option.zoom,
    center: {lat: mapa.Option.LatCenter, lng: mapa.Option.LngCenter},
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  map = new google.maps.Map(document.getElementById('map-slide'), mapOptions );
	//var infowindow = new google.maps.InfoWindow();
	
  
	marker = new google.maps.Marker({
    position: {lat: mapa.Marker.Lat, lng: mapa.Marker.Lng},
    icon: "../img/PointSensor.png",
    title: "WAPOSAT",
    map: map,
    animation: google.maps.Animation.DROP  
  });

  //marker.addListener('click', toggleBounce);
  toggleBounce();
}

function toggleBounce() {
  if (marker.getAnimation() == null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}


//Lat/Long for Hawaii coordinates
var lat = (19.542915); 
var lon = (-155.665857);

//Load map to Hawaii coordinates
var hawaii = new google.maps.LatLng(lat, lon);
var mapProp = {
	center: hawaii,
	zoom: 8,
	mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map = new google.maps.Map(document.getElementById('map-canvas'), mapProp);

$("#viewMap").on('shown.bs.modal', function(){
	//initialize();
	google.maps.event.trigger(map, 'resize');
	map.setCenter(new google.maps.LatLng(19.542915, -155.665857));
});

//Kml Parser that enables to render kml polygons as Google map api objects
var geoXml = new geoXML3.parser({
	map: map,
	singleInfoWindow: true,
	afterParse: displayKml
});

//Allows to parse files and render them from local files
geoXml.parse(['datafiles/tsunami_evac_zones_test_result.kml', 'datafiles/doc.kml', 'datafiles/hawaii_50mwind.kml']);   

//This function will display any of the kml polygons, 
//depending on which type of hazard the user chooses.
function displayKml(doc){ var numberOfPolys = doc[0].gpolygons.length; var numberOfPolys1= doc[1].gpolygons.length; var numberOfPolys2= doc[2].gpolygons.length; for(var i = 0; i < numberOfPolys; i++) { doc[0].gpolygons[i].setMap(null); } for(var i = 0; i < numberOfPolys1; i++) { doc[1].gpolygons[i].setMap(null); } for(var i = 0; i < numberOfPolys2; i++) { doc[2].gpolygons[i].setMap(null); } $("#tsunami").click(function(){
		for(var i = 0; i < numberOfPolys; i++) { doc[0].gpolygons[i].setMap(map); } for(var i = 0; i < numberOfPolys1; i++) { doc[1].gpolygons[i].setMap(null); } for(var i = 0; i < numberOfPolys2; i++) { doc[2].gpolygons[i].setMap(null); }     });  $("#lavaflow").click(function(){
		 for(var i = 0; i < numberOfPolys; i++) { doc[0].gpolygons[i].setMap(null); } for(var i = 0; i < numberOfPolys1; i++) { doc[1].gpolygons[i].setMap(map); } for(var i = 0; i < numberOfPolys2; i++) { doc[2].gpolygons[i].setMap(null); }     });  $("#hurricane").click(function(){
		 for(var i = 0; i < numberOfPolys1; i++) { doc[1].gpolygons[i].setMap(null); } for(var i = 0; i < numberOfPolys; i++) { doc[0].gpolygons[i].setMap(null); } for(var i = 0; i < numberOfPolys2; i++) { doc[2].gpolygons[i].setMap(map); }     });  }
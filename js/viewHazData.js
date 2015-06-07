/*Author: Robert Peralta */

/*
This script will redefine google maps api within the canvas
because of loading issues. Also this script will allow the 
user to view the hazard data through for loops that loop through 
each polygon within a KML file and access the database
based on the location using ajax calls.
*/

//Icons within google maps
var markers = [];

//Lat/Long for Hawaii coordinates
var lat = (19.542915); 
var lon = (-155.665857);

//Initial variable for identifying location
var grabLoc = null;

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

//Search bar and coordinates
var input = /** @type {HTMLInputElement} */(document.getElementById('pac-input'));
//map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

var searchBox = new google.maps.places.SearchBox(
/** @type {HTMLInputElement} */(input));

// [START region_getplaces]
// Listen for the event fired when the user selects an item from the
// pick list. Retrieve the matching places for that item.
google.maps.event.addListener(searchBox, 'places_changed', function() {
	var places = searchBox.getPlaces();

	if (places.length == 0) {
		return;
	}
	for (var i = 0, marker; marker = markers[i]; i++) {
		marker.setMap(null);
	}

	// For each place, get the icon, place name, and location, output location
	markers = [];
	//var txtOutput = document.getElementById("txtOutput");
	var bounds = new google.maps.LatLngBounds();
	for (var i = 0, place; place = places[i]; i++) {
		var image = {
			url: place.icon,
			size: new google.maps.Size(71, 71),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(17, 34),
			scaledSize: new google.maps.Size(25, 25)
		};

		// Create a marker for each place.
		var marker = new google.maps.Marker({
			map: map,
			icon: image,
			title: place.name,
			position: place.geometry.location
		});

		markers.push(marker);
		bounds.extend(place.geometry.location);
	}
	map.fitBounds(bounds);
	
	//Displays Coordinates (lat, long)
	var grabLoc = marker.position;
	//txtOutput.value = grabLoc;
	
	//Kml Parser that enables to render kml polygons as Google map api objects
	var geoXml = new geoXML3.parser({
		map: map,
		singleInfoWindow: true,
		afterParse: useTheData
	});

	//Allows to parse files and render them from local files
	geoXml.parse(['datafiles/tsunami_evac_zones_test_result.kml', 'datafiles/doc.kml', 'datafiles/BigIslandBoundary.kml']);
	
	//allows objects to be manipulated after parse renders objects
	function useTheData(doc) {
		//Geodata handling goes here, using JSON properties of the doc object
		//Number of polygons within Kml file
		var numPolys = doc[0].gpolygons.length;
		var numPolys2 = doc[1].gpolygons.length;
		var numPolys3 = doc[2].gpolygons.length;
		
		//console.log(numPolys3);
		
		// Loop through each polygon
		for(var i = 0; i < numPolys; i++){
			//hide all the polygons within kml file
			doc[0].gpolygons[i].setMap(null);
		};	
		
		for(var i = 0; i < numPolys2; i++){
			//hide all the polygons within kml file
			doc[1].gpolygons[i].setMap(null);
		};
		
		for(var i = 0; i < numPolys3; i++){
			//hide all the polygons within kml file
			doc[2].gpolygons[i].setMap(null);
		};
						
		//Single out a certain polygon for visualization
		//doc[0].gpolygons[6].setMap(map);
		
		//Function contains "Contains" from v3_epoly.js file
		//Determines if a function is within a certain polygon
		//Will use for loop for outer custom geopolygon to see if out of big island
		for(var i = 0; i <= numPolys; i++){
			
			if(doc[2].gpolygons[0].Contains(grabLoc)){ 
				if(i < numPolys){
					if(doc[0].gpolygons[i].Contains(grabLoc)){
						tsunamiZone.value = 1;
						
						//zone 9
						//lavaZone.value = doc[1].placemarks[0].name;
						
						var haz1 = 2;
						//lavaZone.value = doc[1].placemarks[6].name;
						
						var tsunamiValue = tsunamiZone.value;
						
						$("#hazIdent").val('1');
						$("#hazValue").val(zoneValue);
						
						var val = 'Hazard_idHazard='+ haz1 +'&hazVal='+ tsunamiZone.value;
						
						$.ajax({
							method: "POST",
							url: "php/findDesc.php",
							data: val,
							cache: false,
							success : function(data) {
								tsuDesc.value = data;
							}
						});
						
						$.ajax({
							method: "POST",
							url: "php/findMit.php",
							data: val,
							cache: false,
							success : function(data) {
								tsuMit.value = data;
							}
						});
						
						$.ajax({
							method: "POST",
							url: "php/findSrc.php",
							data: val,
							cache: false,
							success : function(data) {
								tsuSrc.value = data;
							}
						});
						break;
					}
				}else if(i == numPolys){
					tsunamiZone.value = 0;
					
					//zone 9
					//lavaZone.value = doc[1].placemarks[0].name;
					
					var haz1 = 2;
					//lavaZone.value = doc[1].placemarks[6].name;
					
					var tsunamiValue = tsunamiZone.value;
					
					$("#hazIdent").val('0');
					$("#hazValue").val(zoneValue);
					
					var val = 'Hazard_idHazard='+ haz1 +'&hazVal='+ tsunamiZone.value;
					
					$.ajax({
						method: "POST",
						url: "php/findDesc.php",
						data: val,
						cache: false,
						success : function(data) {
							tsuDesc.value = data;
						}
					});
					
					$.ajax({
						method: "POST",
						url: "php/findMit.php",
						data: val,
						cache: false,
						success : function(data) {
							tsuMit.value = data;
						}
					});
					
					$.ajax({
						method: "POST",
						url: "php/findSrc.php",
						data: val,
						cache: false,
						success : function(data) {
							tsuSrc.value = data;
						}
					});
				}
			}else{
				tsunamiZone.value = "Outside Big Island";
				tsuDesc.value = "Outside Big Island";
				tsuMit.value = "Outside Big Island";
				tsuSrc.value = "Otuside Big Island";
			}
		};
		
		for(var i = 0; i <= numPolys2; i++){
		
			if(i < numPolys2){
				if(doc[1].gpolygons[i].Contains(grabLoc)){		
					//zone 9
					lavaZone.value = doc[1].placemarks[i].name;
					
					var haz2 = 1;
					//lavaZone.value = doc[1].placemarks[6].name;
					
					var zoneValue = lavaZone.value;
					
					$("#hazIdent").val('2');
					$("#hazValue").val(zoneValue);
					
					var val = 'Hazard_idHazard='+ haz2 +'&hazVal='+ lavaZone.value;
					
					$.ajax({
						method: "POST",
						url: "php/findDesc.php",
						data: val,
						cache: false,
						success : function(data) {
							lavaDesc.value = data;
						}
					});
					
					$.ajax({
						method: "POST",
						url: "php/findMit.php",
						data: val,
						cache: false,
						success : function(data) {
							lavaMit.value = data;
						}
					});
					
					$.ajax({
						method: "POST",
						url: "php/findSrc.php",
						data: val,
						cache: false,
						success : function(data) {
							lavaSrc.value = data;
						}
					});
					break;
				}
			}else{
				lavaZone.value = 'Outside of Big Island';
				lavaDesc.value = 'Outside of Big Island';
				lavaMit.value = 'Outside of Big Island';
				lavaSrc.value = 'Outside of Big Island';
			}
		};
		
		$("#HazArray").show();
		
		//Dialog box 
		$(function() {
			$( "#Dialog" ).dialog({
				//autoOpen: false,
				modal: false,
				width: 500,
				height: 400
			});
		});
	};
});

// [END region_getplaces]
// Bias the SearchBox results towards places that are within the bounds of the
// current map's viewport.
google.maps.event.addListener(map, 'bounds_changed', function() {
	var bounds = map.getBounds();
	searchBox.setBounds(bounds);
});
var markers = [];
//Lat/Long for Hawaii coordinates
var lat = (19.542915); 
var lon = (-155.665857);
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
		// Geodata handling goes here, using JSON properties of the doc object
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
		
		//Lava Flow Zones
		/*for(var i = 0; i < numPolys2; i++){
			if(doc[1].gpolygons[i].Contains(grabLoc)){
				lavaZone.value = doc[1].placemarks[i].name;
				break;
			} else {
				lavaZone.value = '0';
				break;
			}
		}*/
		
		//Lava Zone descriptions from 1-9.
		/*var lavaZoneDes = [
			'1 - Greater than 25% of area covered by lava since 1800. Includes the summits and rift zones of Kilauea and Mauna Loa where vents have been repeatedly active in historic time.',
			'2 - 15-25% of area covered by lava since 1800. Areas adjacent to and downslope of active rift zones.',
			'3 - 1-5% covered by lava since 1800. Areas gradationally less hazardous than Zone 2 because of greater distance from recently active vents and/or because the topography makes it less likely that flows will cover these areas.',
			'4 - About 5% of area covered by lava since 1800. Includes all of Hualalai, where the frequency of eruptions is lower than on Kilauea and Mauna Loa. Flows typically cover large areas.',
			'5 - 0 % of area covered by lava since 1800. Areas currently protected from lava flows by the topography of the volcano.',
			'6 - 0% of area covered by lava since 1800. Areas currently protected from lava flows by the topography of the volcano.',
			'7 - 0% of area covered by lava since 1800. 20 percent of this area covered by lava in the last 10,000 yrs.',
			'8 - 0% of area covered by lava since 1800. Only a few percent of this area covered in the past 10,000 yrs.',
			'9 - 0% of area covered by lava since 1800. No eruption in this area for the past 60,000 yrs.',
			'Outside Big Island'
		]
		
		//Lava Zone mitigations from 1-9.
		var lavaZoneMit = 
		[
			'Particulate filter or respirator, dust masks, and/or goggles. Sturdy shoes. Difficult to get loan for a home here. Hawaii Property Insurance Associatioon temporarily stopped issuing insurance polices here. Go through lloyds of london, but insurance premiums higher. If in direct path of lava, unfortunately currently nothing can protect home from lava.',
			'Particulate filter or respirator, dust masks, and/or goggles. Sturdy shoes. Difficult to get loan for a home here. Hawaii Property Insurance Associatioon temporarily stopped issuing insurance polices here. Go through lloyds of london, but insurance premiums higher. If in direct path of lava, unfortunately currently nothing can protect home from lava.',
			'Buy a particulate filter or respirator, dust masks, and/or goggles. Sturdy shoes may help as well. Stay indoors for ashfall with windows and doors closed',
			'Buy a particulate filter or respirator, dust masks, and/or goggles. Sturdy shoes may help as well. Stay indoors for ashfall with windows and doors closed',
			'Buy a particulate filter or respirator, dust masks, and/or goggles. Sturdy shoes may help as well. Stay indoors for ashfall with windows and doors closed. If in direct path of lava, unfortunately currently nothing can protect your home from lava.',
			'Buy a particulate filter or respirator, dust masks, and/or goggles. Sturdy shoes may help as well. Stay indoors for ashfall with windows and doors closed. If in direct path of lava, unfortunately currently nothing can protect your home from lava.',
			'Property and health most likely safe from lava in this location. Possibly buy face mask respirator',
			'Property and health most likely safe from lava in this location. Possibly buy face mask respirator',
			'Property and health most likely safe from lava in this location. Possibly buy face mask respirator',
			'Outside Big Island'						

		]
		
		//Lava Zone Sources from 1-9
		var lavaZoneSrc = 
		[
			'http://www.lloyds.com/ http://www.homedepot.com/p/Sundstrom-Safety-Silicone-Half-Mask-Respirator-SR-100-M-L/202714568 http://www.homedepot.com/p/Sundstrom-Safety-P100-Particulate-Filter-SR-510/202714579',
			'http://www.lloyds.com/ http://www.homedepot.com/p/Sundstrom-Safety-Silicone-Half-Mask-Respirator-SR-100-M-L/202714568 http://www.homedepot.com/p/Sundstrom-Safety-P100-Particulate-Filter-SR-510/202714579',
			'http://www.homedepot.com/p/Sundstrom-Safety-P100-Particulate-Filter-SR-510/202714579',
			'http://www.homedepot.com/p/Sundstrom-Safety-P100-Particulate-Filter-SR-510/202714579', 
			'http://www.lloyds.com/ http://www.homedepot.com/p/Sundstrom-Safety-Silicone-Half-Mask-Respirator-SR-100-M-L/202714568 http://www.homedepot.com/p/Sundstrom-Safety-P100-Particulate-Filter-SR-510/202714579',
			'http://www.lloyds.com/ http://www.homedepot.com/p/Sundstrom-Safety-Silicone-Half-Mask-Respirator-SR-100-M-L/202714568 http://www.homedepot.com/p/Sundstrom-Safety-P100-Particulate-Filter-SR-510/202714579',
			'http://www.homedepot.com/p/Sundstrom-Safety-Silicone-Half-Mask-Respirator-SR-100-M-L/202714568',
			'http://www.homedepot.com/p/Sundstrom-Safety-Silicone-Half-Mask-Respirator-SR-100-M-L/202714568',
			'http://www.homedepot.com/p/Sundstrom-Safety-Silicone-Half-Mask-Respirator-SR-100-M-L/202714568',
			'Outside Big Island'
			
		]*/
		
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
		
		//Hurricane Zones-Use this when can place zone level values on each polygon
		//first check if within Big Island
		/*
		if(doc[3].gpolygons[0].Contains(grabLoc)){
			for(var i = 0; i < numPolys3; i++)
			{
				if(doc[2].gpolygons[i].Contains(grabLoc))
				{
					hurricaneZone.value = doc[2].placemarks[i].name;
					break
				}
			}	
		}else{  //if not within Big Island
			hurricaneZone.value = "Outside Big Island";
			hurrDes.value = "Outside Big Island";
			hurrMit.value = "Outside Big Island";
			hurrSrc.value = "Otuside Big Island";
		}
		*/
		
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
		
		//<!--evacuation zone polygon-->
		/*var zoneCoords1 = [
			//new google.maps.LatLng(doc[0].gpolygons[8].coords)
			
		];	
		
	
		var hawaiiZone1 = new google.maps.Polygon({
			paths: zoneCoords1
		});

		hawaiiZone1.setMap(map);*/
		//<!--check if point is within the evacuation zone-->
		/*var locOutput = document.getElementById("locOutput");
		if (google.maps.geometry.poly.containsLocation(grabLoc, hawaiiZone1)){
			locOutput.value = '1';
		}else{
			locOutput.value = '0';
		}*/

	};
});

// [END region_getplaces]
// Bias the SearchBox results towards places that are within the bounds of the
// current map's viewport.
google.maps.event.addListener(map, 'bounds_changed', function() {
	var bounds = map.getBounds();
	searchBox.setBounds(bounds);
});
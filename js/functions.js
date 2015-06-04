//jquery code
$(document).ready(function(){

	$(function () {
		$('#myCarousel').carousel({
			interval: 5000
		});
		$('#myCarousel').on('slid.bs.carousel', function (e) {
			if ($('.carousel-inner .item:last').hasClass('active')) {
				$('#myCarousel').carousel('pause');
			}
			if ($('.carousel-inner .item:first').hasClass('active')) {
				$('#myCarousel').carousel('cycle');
			}
		});
	});

	var c = $('#map-canvas');
	var container = $(c).parent();

	//Run function when browser resizes
	$(window).resize( respondCanvas );

	function respondCanvas(){ 
		c.attr('width', $(container).width() ); //max width
		c.attr('height', $(container).height() ); //max height

		//Call a function to redraw other content (texts, images etc)
	}

	//Initial call 
	respondCanvas();
	
	//side bar layer selection buttons etc
	$("#HazArray").hide();
	$("#sidebar").hide();
	$("#loginForm").hide();
	
	/*$("#login").click(function(){
		$(this).hide();
		$("#Print").hide();
		$("#mapArea").hide();
		$("#loginForm").show();
		$("#sideBarBtn").hide();
	});*/
	
	$("#PrintDialog").hide();
	
	$("#closeSidebar").click(function(){
		$("#sidebar").hide();
		$("#content").css("width", "100%");
		$("#sideBarBtn").show();
	});
	
	$("#sideBarBtn").click(function(){
		$(this).hide();
		$("#content").css("width", "85%");
		$("#sidebar").show();
	});
	
	/*$(function(){
		$("#HazArray").menu();
	});*/
	
	/*$(function(){
		$("#coordData").accordion();
	});
	
	$(function(){
		$("#coordMit").accordion();
	});
	
	$(function(){
		$("#coordSrc").accordion();
	});*/
	
	//hazard array hover style
	$(function(){
		$("#tsunData").accordion({
			heightStyle: "content",
			event: "click hoverintent"
		});
	});
	
	$(function(){
		$("#lavaData").accordion({
			heightStyle: "content",
			event: "click hoverintent"
		});
	});
	
	$(function(){
		$("#hurrData").accordion({
			heightStyle: "content",
			event: "click hoverintent"
		});
	});
	
	$.event.special.hoverintent = {
		setup: function() {
			$( this ).bind( "mouseover", jQuery.event.special.hoverintent.handler );
		},
		teardown: function() {
			$( this ).unbind( "mouseover", jQuery.event.special.hoverintent.handler );
		},
		
		handler: function( event ) {
			var currentX, currentY, timeout,
			args = arguments,
			target = $( event.target ),
			previousX = event.pageX,
			previousY = event.pageY;
	 
			function track( event ) {
				currentX = event.pageX;
				currentY = event.pageY;
			};
	 
			function clear() {
				target
				.unbind( "mousemove", track )
				.unbind( "mouseout", clear );
				clearTimeout( timeout );
			}
	 
			function handler() {
				var prop,
				orig = event;
	 
			if ( ( Math.abs( previousX - currentX ) +
				Math.abs( previousY - currentY ) ) < 7 ) {
					clear();
	 
					event = $.Event( "hoverintent" );
					for ( prop in orig ) {
							if ( !( prop in event ) ) {
							event[ prop ] = orig[ prop ];
						}
					}
					
					// Prevent accessing the original event since the new event
					// is fired asynchronously and the old event is no longer
					// usable (#6028)
					delete event.originalEvent;
		 
					target.trigger( event );
				} else {
					previousX = currentX;
					previousY = currentY;
					timeout = setTimeout( handler, 100 );
				}
			}	
	 
			timeout = setTimeout( handler, 100 );
			target.bind({
				mousemove: track,
				mouseout: clear
			});
		}
	}
	
	$("#submit").click(function(){
		$("#loginForm").hide();
		//$("#Admin").show();
		$("#Print").show();
		$("#map-canvas").show();
		//$("#logout").show();
	});
});

//Shows current location
/*var x = document.getElementByID("message");

function getLocation() {

	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else { 
		x.innerHTML = "Geolocation is not supported by this browser.";
	}
}*/

//google maps api functions, geoxml parsing, &
function initialize(){
	
	$.getScript("js/viewHazData.js", function(){
		//console.log('worked');
	});
	
	$.getScript("js/display.js", function(){
		//console.log('worked');
	});
	
	//Kml Parser that enables to render kml polygons as Google map api objects
	/*var geoXml = new geoXML3.parser({
		map: map,
		singleInfoWindow: true,
		afterParse: displayKml
	});

	//Allows to parse files and render them from local files
	geoXml.parse(['datafiles/tsunami_evac_zones_test_result.kml', 'datafiles/doc.kml', 'datafiles/hawaii_50mwind.kml']);
	
	//This function will display any of the kml polygons, 
	//depending on which type of hazard the user chooses.
	function displayKml(doc){
		var numberOfPolys = doc[0].gpolygons.length;
		var numberOfPolys2 = doc[1].gpolygons.length;
		var numberOfPolys3 = doc[2].gpolygons.length;
		var value = null;
		
		//console.log(numberOfPolys2);
		//console.log(doc[1].placemarks.length);
		
		//Initially nullify all maps for kml 1
		for(var i = 0; i < numberOfPolys; i++){
			doc[0].gpolygons[i].setMap(null);
		}
		
		//Initially nullify all maps for kml 2
		for(var i = 0; i < numberOfPolys2; i++){
			doc[1].gpolygons[i].setMap(null);
		}
		
		for(var i = 0; i < numberOfPolys3; i++){
			doc[2].gpolygons[i].setMap(null);
		}
		
		$("#tsunami").click(function(){
			for(var i = 0; i < numberOfPolys; i++){
				doc[0].gpolygons[i].setMap(map);
			}
			for(var i = 0; i < numberOfPolys2; i++){
				doc[1].gpolygons[i].setMap(null);
			}
			for(var i = 0; i < numberOfPolys3; i++){
				doc[2].gpolygons[i].setMap(null);
			}
		});	
		
		$("#hurricane").click(function(){
			for(var i = 0; i < numberOfPolys; i++){
				doc[0].gpolygons[i].setMap(null);
			}
			for(var i = 0; i < numberOfPolys2; i++){
				doc[1].gpolygons[i].setMap(null);
			}
			for(var i = 0; i < numberOfPolys3; i++){
				doc[2].gpolygons[i].setMap(map);
			}
		});
		
		$("#lavaflow").click(function(){
			for(var i = 0; i < numberOfPolys; i++){
				doc[0].gpolygons[i].setMap(null);
			}
			for(var i = 0; i < numberOfPolys2; i++){
				doc[1].gpolygons[i].setMap(map);
			}
			for(var i = 0; i < numberOfPolys3; i++){
				doc[2].gpolygons[i].setMap(null);
			}
		});
		
		$("#vog").click(function(){
			for(var i = 0; i < numberOfPolys; i++){
				doc[0].gpolygons[i].setMap(null);
			}
			for(var i = 0; i < numberOfPolys2; i++){
				doc[1].gpolygons[i].setMap(null);
			}
			for(var i = 0; i < numberOfPolys3; i++){
				doc[2].gpolygons[i].setMap(null);
			}
		});
	}*/
	
	//KML Layers
	/*var tsunamiEvac = new google.maps.KmlLayer({
		url: 'http://oos.soest.hawaii.edu/pacioos/kml/zzz_obsolete/tsunami_evac_zones.kml'
		
	});
	
	var tsunamiOutline = new google.maps.KmlLayer({
		url: 'http://geocommons.com/overlays/3307.kml'
	});
	
	$("#tsunami").click(function(){
		tsunamiOutline.setMap(null);
		tsunamiEvac.setMap(map);
	});
	
	$("#hurricane").click(function(){
		tsunamiOutline.setMap(map);
		tsunamiEvac.setMap(null);
	});*/
	
	function showError(error) {
		switch(error.code) {
			case error.PERMISSION_DENIED:
				x.innerHTML = "User denied the request for Geolocation."
				break;
			case error.POSITION_UNAVAILABLE:
				x.innerHTML = "Location information is unavailable."
				break;
			case error.TIMEOUT:
				x.innerHTML = "The request to get user location timed out."
				break;
			case error.UNKNOWN_ERROR:
				x.innerHTML = "An unknown error occurred."
				break;
		}
	}
	
}
//google.maps.event.addDomListener(window, 'load', initialize);
//$(document).ready(function() { initialize();});
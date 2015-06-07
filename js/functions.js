/*Author: Robert Peralta*/

/*
This script will allow a regular user to view 
the KML files on google maps api as well as view
hazard data from the hazard array.

*/

//jquery code
$(document).ready(function(){

	//Define carousel (Slideshow) that displays hazard info
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

	//Defines canvas map
	var c = $('#map-canvas');
	//Defines container that holds canvas
	var container = $(c).parent();

	//Run function when browser resizes
	$(window).resize( respondCanvas );

	//Grabs the canvas height and width
	function respondCanvas(){ 
		c.attr('width', $(container).width() ); //max width
		c.attr('height', $(container).height() ); //max height

		//Call a function to redraw other content (texts, images etc)
	}

	//Initial call 
	respondCanvas();
});

//google maps api functions, geoxml parsing, &
function initialize(){
	
	$.getScript("js/viewHazData.js", function(){
		//console.log('worked');
	});
	
	$.getScript("js/display.js", function(){
		//console.log('worked');
	});
	
	
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
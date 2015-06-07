/*Author: Robert Peralta */

/*
This script will allow an admin to modify hazard data 
which will be automatically updated through ajax calls 
to the database. 
*/

//jquery code
$(document).ready(function(){
	
	//Define HTML canvas as c
	var c = $('#map-canvas');
	//Define container to hold canvas parent
	var container = $(c).parent();

	//Run function when browser resizes
	$(window).resize( respondCanvas );

	//Define respond function to grab width and height of canvas
	function respondCanvas(){ 
		c.attr('width', $(container).width() ); //max width
		c.attr('height', $(container).height() ); //max height

		//Call a function to redraw other content (texts, images etc)
	}

	//Initial call 
	respondCanvas();
	
	$(function(){
		$("#HazArray").menu();
	});		
	
	//Allows the modified data to be updated without refreshing the page.
	function refreshTable(str){
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("updateHazTable").innerHTML = xmlhttp.responseText;
			}
		}
		//Gets requested string data fro updateHazards.php
		xmlhttp.open("GET","php/updateHazards.php?q="+str,true);
		xmlhttp.send();
	}
	
	//Initial variables for adding and deleting data within table
	var i = 1;
	var y = 1;
	var d = 0;
	var e = 0;
	
	//Modify data on the newly added row
	$("#modHaz").on("click", ".addRow", function(){
		
		//Define Unique ID given from the from modify hazard form
		var j = $("#uniqueID").val(); 
		//Define Hazard ID from database
		var hazID = $("#HazID").val();
		
		//Zone level for given hazard
		var n = $("#zoneID_"+i).val();
		var zoneID = Number(n);
		d = zoneID + e;
		
		//Initial variables for Haz data
		var hazval = 0;
		var hazdesc = "";
		var hazmit = "";
		var hazsrc = "";
		var data1 = "";
	
		//Displays two colors for the hazard rows one for odd and one for even.
		if(y%2){
			data1="<tr id='" + i + "' class='editRow'>";
		}else{
			data1="<tr id='" + i + "' bgcolor='C2C2C2' class='editRow'>";
		}
		
		//Setting up the modified HTML code that is changed as rows are added
		data1 += "<input type='hidden' name='zoneID_" + i + "' id='zoneID_" + i + "' value='" + d + "'>" +
				  "<td><input id='check_" + d + "' type='checkbox' class='case'/></td>" + 
					"<td class='edit_td'>" +
						"<span id='hazv_" + i + "' class='text' sytle='display: inline;'></span>" +
						"<input type='text' class='editCell' id='hazval_" + i + "' value=''/></input></td>" +
					"<td class='edit_td'>" +
						"<span id='hazd_" + i + "' class='text' sytle='display: inline;'></span>" +
						"<input type='text' class='editCell' id='hazdesc_" + i + "' value=''/></input></td>" +
					"<td class='edit_td'>" +
						"<span id='hazm_" + i + "' class='text' sytle='display: inline;'></span>" +
						"<input type='text' class='editCell' id='hazmit_" + i + "' value=''/></input></td>" +
					"<td class='edit_td'>" +
						"<span id='hazs_" + i + "' class='text' sytle='display: inline;'></span>" +
						"<input type='text' class='editCell' id='hazsrc_" + i + "' value=''/></input></td>" +
				  "</tr>" +
				  "<input type='hidden' name='HazID' id='HazID_" + i + "' value='" + hazID + "'>" ;
		
		//Modify the data in the table
		$('table').append(data1);
		
		//String data that is queried to the database
		var val = 'Hazard_idHazard=' + hazID + '&hazVal=' + hazval + '&hazDesc=' + hazdesc + '&hazMit=' + hazmit + '&hazSrc=' + hazsrc;
		
		//Ajax call for asynchronous response
		$.ajax({
			type: "POST",
			url: "php/addQuery.php",
			data: val,
			cache: false,
			success : function(data) {
				console.log(val);
				refreshTable(hazID);
			}
		});
		
		//Update variables for a new row to be implemented
		y++;
		i++;
		e++;
		
	});
	
	//Modify data that already exists within the table
	$("#modHaz").on("click", ".editRow", function() {
		
		//retrieve the id for the row
		var ID = $(this).attr('id');
		
		//hide all info within static cell
		$("#hazv_"+ID).hide();
		$("#hazd_"+ID).hide();
		$("#hazm_"+ID).hide();
		$("#hazs_"+ID).hide();
		
		//Show all data with in dynic cell
		$("#hazval_"+ID).show();
		$("#hazdesc_"+ID).show();
		$("#hazmit_"+ID).show();
		$("#hazsrc_"+ID).show();
		
	}).on("change", ".editRow", function(){
		
		//retrieve row id and other form values given when data entered
		var ID = $(this).attr('id');
		var zoneID = $("#zoneID_"+ID).val();
		var hazdesc = $("#hazdesc_"+ID).val();
		var hazmit = $("#hazmit_"+ID).val();
		var hazsrc = $("#hazsrc_"+ID).val();
		var hazval = $("#hazval_"+ID).val();
		var hazID = $("#HazID").val();
		//$("#hazd_"+ID).html('<img src="images/load.gif" />');
		
		//String data to be queried to the database
		var val = 'idHazardZone=' + zoneID + '&hazDesc=' + hazdesc + '&hazMit=' + hazmit + '&hazSrc=' + hazsrc + '&hazVal=' + hazval;
		
		//Ajax call to update any given info
		$.ajax({
			type: "POST",
			url: "php/updatequery.php",
			data: val,
			cache: false,
			success : function(data) {
				$("#hazdesc_"+ID).html(hazdesc);
				$("#hazmit_"+ID).html(hazmit);
				$("#hazsrc_"+ID).html(hazsrc);
				$("#hazval_"+ID).html(hazval);
				$("#hazd_"+ID).html(hazdesc);
				$("#hazm_"+ID).html(hazmit);
				$("#hazs_"+ID).html(hazsrc);
				$("#hazv_"+ID).html(hazval);
				console.log(val);
			},
			error: function () {
				// Uh oh, something went wrong
				alert("uh oh");
			}
		});
	});
	
	//Delete a row from the table
	$("#modHaz").on("click", ".deleteRow", function() {
		
		//Finds the checked row of the delete section on table form
		var ID = $('.case:checkbox:checked').closest('tr').attr('id');
		
		//retrieves zone id
		var zoneID = $("#zoneID_"+ID).val();
		
		//String data to be passed to the database
		var val = 'idHazardZone=' + zoneID;
		
		//Removes the row from the form table
		$('.case:checkbox:checked').parents("tr").remove();
		
		//Ajax call to delete the given haz data of that row
		$.ajax({
			type: "POST",
			url: "php/deleteQuery.php",
			data: val,
			cache: false,
			success : function(data) {
			
			}
		});
	});
	
	$(".editCell").mouseup(function() {
		return false;
	});

	// Outside click action
	$(document).mouseup(function(){
		$(".editCell").hide();
		$(".text").show();
	});
	
	//Table refresh 
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
	
	$("#HazArray").hide();
});

//google maps api functions, geoxml parsing, &
function initialize(){

	//Call the view hazard script to view the hazards
	$.getScript("js/viewHazData.js", function(){
	
	});
	
	//Call the display script to display buttons
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
//jquery code
$(document).ready(function(){
	
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
	$("#sidebar").hide();
	$("#AdminMenu").hide();
	$("#viewForm").hide();
	$("#modHaz").hide();
	$("#addHazardInfo").hide();
	$("#PrintDialog").hide();
	$("#addForm").hide();
	$("#addMethod").hide();
	
	$("#closeSidebar").click(function(){
		$("#sidebar").hide();
		$("#content").css("width", "100%");
		$("#sideBarBtn").show();
		$("#AdminBtn").show();
	});
	
	$("#closeAdminMenu").click(function(){
		$("#sidebar").hide();
		$("#content").css("width", "100%");
		$("#sideBarBtn").show();
		$("#AdminBtn").show();
		$("#AdminMenu").hide();
	});
	
	$("#sideBarBtn").click(function(){
		$(this).hide();
		$("#content").css("width", "85%");
		$("#sidebar").show();
		$("#AdminBtn").hide();
	});
	
	$("#AdminBtn").click(function(){
		$(this).hide();
		$("#content").css("width", "88%");
		$("#sideBarBtn").hide();
		$("#AdminMenu").show();
	});
	
	$("#viewData").click(function(){
		$("#mapArea").hide();
		$("#Print").hide();
		$("#modHaz").hide();
		$("#addForm").hide();
		$("#addHazardInfo").hide();
		$("#addMethod").hide();
		$("#viewForm").show();
	});
	
	$("#modifyData").click(function(){
		$("#mapArea").hide();
		$("#Print").hide();
		$("#viewForm").hide();
		$("#addForm").hide();
		$("#addHazardInfo").hide();
		$("#addMethod").hide();
		$("#modHaz").show();
	});
	
	$("#addData").click(function(){
		$("#mapArea").hide();
		$("#Print").hide();
		$("#viewForm").hide();
		$("#addForm").hide();
		$("#addHazardInfo").hide();
		$("#modHaz").hide();
		$("#addMethod").show();
	});
	
	$("#insertHaz").click(function(){
		$("#addMethod").hide();
		$("#addForm").show();
	});
	
	$("#insertInfo").click(function(){
		$("#addMethod").hide();
		$("#addHazardInfo").show();
	});
	
	$("#backButton").click(function(){
		$("#addHazardInfo").hide();
		$("#addMethod").show();
	});
	
	$("#back").click(function(){
		$("#mapArea").show();
		$("#Print").show();
		$("#viewForm").hide();
		
	});
	
	$("#back1").click(function(){
		$("#mapArea").show();
		$("#Print").show();
		$("#modHaz").hide();
	
	});
	
	$("#back2").click(function(){
		$("#addMethod").show();
		$("#addForm").hide();
	
	});
	
	$("#back3").click(function(){
		$("#mapArea").show();
		$("#Print").show();
		$("#addMethod").hide();
		$("#addForm").hide();
	});
	
	$(function(){
		$("#HazArray").menu();
	});
			
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
		xmlhttp.open("GET","php/updateHazards.php?q="+str,true);
		xmlhttp.send();
	}
	
	var i = 1;
	var y = 1;
	var d = 0;
	var e = 0;
	
	$("#modHaz").on("click", ".addRow", function(){
		
		var j = $("#uniqueID").val(); 
		var hazID = $("#HazID").val();
		
		var n = $("#zoneID_"+i).val();
		var zoneID = Number(n);
		d = zoneID + e;
		
		var hazval = 0;
		var hazdesc = "";
		var hazmit = "";
		var hazsrc = "";
		var data1 = "";
	
		if(y%2){
			data1="<tr id='" + i + "' class='editRow'>";
		}else{
			data1="<tr id='" + i + "' bgcolor='C2C2C2' class='editRow'>";
		}
		
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
				  
		$('table').append(data1);
		
		var val = 'Hazard_idHazard=' + hazID + '&hazVal=' + hazval + '&hazDesc=' + hazdesc + '&hazMit=' + hazmit + '&hazSrc=' + hazsrc;
		
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
		
		y++;
		i++;
		e++;
		
	});
	
	$("#modHaz").on("click", ".editRow", function() {
		
		var ID = $(this).attr('id');
		$("#hazv_"+ID).hide();
		$("#hazd_"+ID).hide();
		$("#hazm_"+ID).hide();
		$("#hazs_"+ID).hide();
		
		$("#hazval_"+ID).show();
		$("#hazdesc_"+ID).show();
		$("#hazmit_"+ID).show();
		$("#hazsrc_"+ID).show();
		
	}).on("change", ".editRow", function(){
	
		var ID = $(this).attr('id');
		var zoneID = $("#zoneID_"+ID).val();
		var hazdesc = $("#hazdesc_"+ID).val();
		var hazmit = $("#hazmit_"+ID).val();
		var hazsrc = $("#hazsrc_"+ID).val();
		var hazval = $("#hazval_"+ID).val();
		var hazID = $("#HazID").val();
		//$("#hazd_"+ID).html('<img src="images/load.gif" />');
		
		var val = 'idHazardZone=' + zoneID + '&hazDesc=' + hazdesc + '&hazMit=' + hazmit + '&hazSrc=' + hazsrc + '&hazVal=' + hazval;
		
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
	
	$("#modHaz").on("click", ".deleteRow", function() {
		
		var ID = $('.case:checkbox:checked').closest('tr').attr('id');
		
		var zoneID = $("#zoneID_"+ID).val();
		
		var val = 'idHazardZone=' + zoneID;
		
		$('.case:checkbox:checked').parents("tr").remove();
		
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
	
	});
	
	$.getScript("js/display.js", function(){
		//console.log('worked');
	});
	
	/*var x = document.createElement('script');
	x.src = 'js/display.js';
	document.getElementsByTagName("head")[0].appendChild(x);*/
		
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
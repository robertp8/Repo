<!DOCTYPE html>
<?php 
	session_start();
	require_once('php/functions.php'); 
	if(check_login_status() == false) {

	redirect('Index.php');
}

?>
<!--Google maps idKey: AIzaSyBDeKh4FF-2J1pT6C82m6XlgdTDmd7AjGk-->
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<title>Home</title>
	<link href="css/stylesheet.css" rel="stylesheet" type="text/css" media="screen">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&=geometry&sensor=false&key=AIzaSyBDeKh4FF-2J1pT6C82m6XlgdTDmd7AjGk"></script>
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script type="text/javascript" src="http://geoxml3.googlecode.com/svn/branches/polys/geoxml3.js"></script>
	<script type="text/javascript" src="http://geoxml3.googlecode.com/svn/trunk/ProjectedOverlay.js"></script>
	<script type="text/javascript" src="js/v3_epoly.js"></script>
	
	<script type="text/javascript">
		function showHazard(str) {
			if (str == "") {
				document.getElementById("hazTable").innerHTML = "";
				return;
			} else { 
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("hazTable").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","php/viewHazards.php?q="+str,true);
				xmlhttp.send();
			}
		}
		
		function modifyHazard(str) {
			if (str == "") {
				document.getElementById("updateHazTable").innerHTML = "";
				return;
			} else { 
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
		}
	
        function PrintDiv() {
			var tsunData1 = document.getElementById("tsuDesc").innerHTML;
			var tsunData2 = document.getElementById("tsuMit").innerHTML;
			var tsunData3 = document.getElementById("tsuSrc").innerHTML;
			var lavaData1 = document.getElementById("lavaDes").innerHTML;
			var lavaData2 = document.getElementById("lavaMit").innerHTML;
			var lavaData3 = document.getElementById("lavaSrc").innerHTML;
			var hurrData1 = document.getElementById("hurrDes").innerHTML;
			var hurrData2 = document.getElementById("hurrMit").innerHTML;
			var hurrData3 = document.getElementById("hurrSrc").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write('<html><head><title>DIV Contents</title>');
            frameDoc.document.write('</head><body>');
            //frameDoc.document.write(contents);
			frameDoc.document.write('<h1>Tsunami</h1>');
			frameDoc.document.write('<h3>Description</h3>');
			frameDoc.document.write(tsunData1);
			frameDoc.document.write('<h3>Mitigation Data</h3>');
			frameDoc.document.write(tsunData2);
			frameDoc.document.write('<h3>Resources</h3>');
			frameDoc.document.write(tsunData3);
			frameDoc.document.write('<h1>Lava</h1>');
			frameDoc.document.write('<h3>Description</h3>');
			frameDoc.document.write(lavaData1);
			frameDoc.document.write('<h3>Mitigation Data</h3>');
			frameDoc.document.write(lavaData2);
			frameDoc.document.write('<h3>Resources</h3>');
			frameDoc.document.write(lavaData3);
			frameDoc.document.write('<h1>Hurricane</h1>');
			frameDoc.document.write('<h3>Description</h3>');
			frameDoc.document.write(hurrData1);
			frameDoc.document.write('<h3>Mitigation Data</h3>');
			frameDoc.document.write(hurrData2);
			frameDoc.document.write('<h3>Resources</h3>');
			frameDoc.document.write(hurrData3);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }
    </script>
</head>
<!--onload execute initialize function in javascript-->
<body>
	
	<?php include('php/dbConnect.php');?>
	<div id="masthead">
		<center>
			<h1>Malama Natural Disaster Awareness</h1>
				
		</center>
		<a id="logout" href="php/logout.php">logout</a>
		<div id="Admin">Welcome <?php echo $_SESSION['username']; ?></div>
		
	</div>
	
		
	<div id="sidebarContent">
		<div id="AdminMenu">
			<div id="closeAdminMenu">X</div>
			
			<div id="viewData">View Data</div>
			<div id="modifyData">Modify Data</div>
			<p>Add Data</p>
			<p>Delete Data</p>
		
		</div>
		<div id="sidebar">
			
			<div id="closeSidebar">X</div>
				<ul>
					<li>Hazard Layers: Click Layers For Description</li>
					<ul>
						<li><input type="radio" name="hazard" value="Tsunami" id="tsunami">Tsunami</input></li>
						<li><input type="radio" name="hazard" value="LavaFlow" id="lavaflow">Lava Flow</input></li>
						<li><input type="radio" name="hazard" value="Hurricane" id="hurricane">Hurricane</input></li>
						<li><input type="radio" name="hazard" value="Vog" id="vog">Vog</input></li>
						<li><input type="radio" name="hazard" value="Flooding" id="flooding">Flooding</input></li>
						<li><input type="radio" name="hazard" value="Storm Surge" id="storm Surge">Storm Surge</input></li>
						<li><input type="radio" name="hazard" value="Earthquake" id="earthquake">Earthquake</input></li>
					</ul>
				</ul>
				<!--<input type="button" value="View Map" id="select">-->
		</div>
	
		<div id="content">	
			
			<div id="AdminBtn">Click To View Options</div>
			<div id="sideBarBtn">Click To View Hazard Layers</div>
			
			<center>
				<h2>Please Enter A Physical Address Or Location</h2>
		
				<div id="map-canvas"></div> <!--google map-->
				
				<input 	id="pac-input" class="controls" type="text" placeholder="Physical Address"></input> <!--location input-->
				
				<!--hazard array-->
				<form id="form1">
					<div id="Dialog" title="Hazard Data">
					
						<ul id="HazArray">
							<li><p>Tsunami Zone: <output id="tsunamiZone" type="text" placeholder="WithinEvacZone"></output></p>
								<ul>
									<li>
										<div id="tsunData">
											<h3>Description</h3>
											<div>
												<p><output id="tsuDesc" type="text"></output></p>
											</div>
											
											<h3>Mitigation</h3>
											<div>
												<p><output id="tsuMit" type="text"></output></p>
											</div>
											
											<h3>Source</h3>
											<div>
												<p><output id="tsuSrc" type="text"></output></p>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<li><p>Lava Zone: <output id="lavaZone" type="text" placeholder="WithinEvacZone"></output></p>
								<ul>
									<li>
										<div id="lavaData">
											<h3>Description</h3>
											<div>
												<p><output id="lavaDes" type="text"></output></p>
											</div>
											
											<h3>Mitigation</h3>
											<div>
												<p><output id="lavaMit" type="text"></output></p>
											</div>
											
											<h3>Source</h3>
											<div>
												<p><output id="lavaSrc" type="text"></output></p>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<li><p>Hurricane Zone: <output id="hurricaneZone" type="text" placeholder="WithinEvacZone"></output></p>
								<ul>
									<li>
										<div id="hurrData">
											<h3>Description</h3>
											<div>
												<p><output id="hurrDes" type="text"></output></p>
											</div>
											
											<h3>Mitigation</h3>
											<div>
												<p><output id="hurrMit" type="text"></output></p>
											</div>
											
											<h3>Source</h3>
											<div>
												<p><output id="hurrSrc" type="text"></output></p>
											</div>
										</div>
									</li>
								</ul>
							</li>
						</ul>
						
					</div>
				</form>
				
				<div id="viewForm">
					<form method="get" action="">
						<select name="hazName" onchange="showHazard(this.value)">
							<?php 
								echo "<option value=\"default\"> ....Select.....</option>";

								$sql = mysqli_query($conn, "SELECT idHazard, hazName FROM hazard");
								while ($row = mysqli_fetch_array($sql, MYSQL_ASSOC)){
									
									$id=$row["idHazard"];
									$name=$row["hazName"]; 
									
									echo '<option value=' . $id . '">' . $name . '</option>';
								}
							?>
						</select>
					</form>
					<br>
					<div id="hazTable"></div>
					<br>
					<div id="back">back</div>
				</div>
				
				<div id="modifyForm">
					<form method="get" action="">
						<select name="hazName" onchange="modifyHazard(this.value)">
							<?php 
								echo "<option value=\"default\"> ....Select.....</option>";

								$sql = mysqli_query($conn, "SELECT idHazard, hazName FROM hazard");
								while ($row = mysqli_fetch_array($sql, MYSQL_ASSOC)){
									
									$id=$row["idHazard"];
									$name=$row["hazName"]; 
									
									echo '<option value=' . $id . '">' . $name . '</option>';
								}
							?>
						</select>
					</form>
					<br>
					<div id="updateHazTable"></div>
					<br>
					<div id="back1">back</div>
				</div>
				<input id="Print" type="button" onclick="PrintDiv();" value="Print a report" />
			</center>
		</div>
	</div>
		
	<div id="footer">
		<center>
			<h3>Disclaimer: Last Reliable Update dd-mm-2014</h3>
	</div>
	<script>
	    //jquery code
		$(document).ready(function(){
			
			//side bar layer selection buttons etc
			$("#sidebar").hide();
			$("#AdminMenu").hide();
			$("#viewForm").hide();
			$("#modifyForm").hide();
			
			$("#PrintDialog").hide();
			
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
				$("#map-canvas").hide();
				$("#Print").hide();
				$("#modifyForm").hide();
				$("#viewForm").show();
			
			});
			
			$("#modifyData").click(function(){
				$("#map-canvas").hide();
				$("#Print").hide();
				$("#viewForm").hide();
				$("#modifyForm").show();
			
			});
			
			$("#back").click(function(){
				$("#map-canvas").show();
				$("#Print").show();
				$("#viewForm").hide();
				
			});
			
			$("#back1").click(function(){
				$("#map-canvas").show();
				$("#Print").show();
				$("#modifyForm").hide();
			
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
			
			//Search bar and coordinates
			var input = /** @type {HTMLInputElement} */(document.getElementById('pac-input'));
			map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
		  
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
					
					console.log(numPolys3);
					
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
					
					
					//Tsunami Zones
					//first check if within Big Island
					if(doc[2].gpolygons[0].Contains(grabLoc)){ 
						if(doc[0].gpolygons[0].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[1].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[2].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[3].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[4].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[5].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[6].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[7].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[8].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[9].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[10].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[11].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[12].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[13].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[14].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else if(doc[0].gpolygons[15].Contains(grabLoc)){
							tsunamiZone.value = '1';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription1.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation1.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources1.txt" );});
						}else{
							tsunamiZone.value = '0';
							$(function(){$( "#tsuDesc" ).load( "mitigationfiles/tsunDescription0.txt" );});
							$(function(){$( "#tsuMit" ).load( "mitigationfiles/tsunMitigation0.txt" );});
							$(function(){$( "#tsuSrc" ).load( "mitigationfiles/tsunSources0.txt" );});
						}
					}
					/*else{ //if not within Big Island
						tsunamiZone.value = "Outside Big Island";
						tsuDesc.value = "Outside Big Island";
						tsuMit.value = "Outside Big Island";
						tsuSrc.value = "Otuside Big Island";
					}*/
					
					
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
					var lavaZoneDes = [
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
						
					]
					
					//Dialogue box with haz descriptions
					if(doc[1].gpolygons[0].Contains(grabLoc)){		
						//zone 9
						lavaZone.value = doc[1].placemarks[0].name;
						lavaDes.value = lavaZoneDes[8];
						lavaMit.value = lavaZoneMit[8];
						lavaSrc.value = lavaZoneSrc[8];
					}else if(doc[1].gpolygons[1].Contains(grabLoc)){
						//zone 8
						lavaZone.value = doc[1].placemarks[1].name;
						lavaDes.value = lavaZoneDes[7];
						lavaMit.value = lavaZoneMit[7];
						lavaSrc.value = lavaZoneSrc[7];
					}else if(doc[1].gpolygons[2].Contains(grabLoc)){
						//zone 3
						lavaZone.value = doc[1].placemarks[2].name;
						lavaDes.value = lavaZoneDes[2];
						lavaMit.value = lavaZoneMit[2];
						lavaSrc.value = lavaZoneSrc[2];
					}else if(doc[1].gpolygons[3].Contains(grabLoc)){
						//zone 7
						lavaZone.value = doc[1].placemarks[3].name;
						lavaDes.value = lavaZoneDes[6];
						lavaMit.value = lavaZoneMit[6];
						lavaSrc.value = lavaZoneSrc[6];
					}else if(doc[1].gpolygons[4].Contains(grabLoc)){
						//zone 4
						lavaZone.value = doc[1].placemarks[4].name;
						lavaDes.value = lavaZoneDes[3];
						lavaMit.value = lavaZoneMit[3];
						lavaSrc.value = lavaZoneSrc[3];
					}else if(doc[1].gpolygons[5].Contains(grabLoc)){
						//zone 2
						lavaZone.value = doc[1].placemarks[5].name;
						lavaDes.value = lavaZoneDes[1];
						lavaMit.value = lavaZoneMit[1];
						lavaSrc.value = lavaZoneSrc[1];
					}else if(doc[1].gpolygons[6].Contains(grabLoc)){
						//zone 3
						lavaZone.value = doc[1].placemarks[6].name;
						lavaDes.value = lavaZoneDes[2];
						lavaMit.value = lavaZoneMit[2];
						lavaSrc.value = lavaZoneSrc[2];
					}else if(doc[1].gpolygons[7].Contains(grabLoc)){
						//zone 2
						lavaZone.value = doc[1].placemarks[7].name;
						lavaDes.value = lavaZoneDes[1];
						lavaMit.value = lavaZoneMit[1];
						lavaSrc.value = lavaZoneSrc[1];
					}else if(doc[1].gpolygons[8].Contains(grabLoc)){
						//zone 1
						lavaZone.value = doc[1].placemarks[8].name;
						lavaDes.value = lavaZoneDes[0];
						lavaMit.value = lavaZoneMit[0];
						lavaSrc.value = lavaZoneSrc[0];
					}else if(doc[1].gpolygons[9].Contains(grabLoc)){
						//zone 1 
						lavaZone.value = doc[1].placemarks[9].name;
						lavaDes.value = lavaZoneDes[0];
						lavaMit.value = lavaZoneMit[0];
						lavaSrc.value = lavaZoneSrc[0];
					}else if(doc[1].gpolygons[10].Contains(grabLoc)){
						//zone 2 
						lavaZone.value = doc[1].placemarks[10].name;
						lavaDes.value = lavaZoneDes[1];
						lavaMit.value = lavaZoneMit[1];
						lavaSrc.value = lavaZoneSrc[1];
					}else if(doc[1].gpolygons[11].Contains(grabLoc)){
						//zone 6
						lavaZone.value = doc[1].placemarks[11].name;
						lavaDes.value = lavaZoneDes[5];
						lavaMit.value = lavaZoneMit[5];
						lavaSrc.value = lavaZoneSrc[5];
					}else if(doc[1].gpolygons[12].Contains(grabLoc)){
						//zone 2
						lavaZone.value = doc[1].placemarks[12].name;
						lavaDes.value = lavaZoneDes[1];
						lavaMit.value = lavaZoneMit[1];
						lavaSrc.value = lavaZoneSrc[1];
					}else if(doc[1].gpolygons[13].Contains(grabLoc)){
						//zone 3
						lavaZone.value = doc[1].placemarks[13].name;
						lavaDes.value = lavaZoneDes[2];
						lavaMit.value = lavaZoneMit[2];
						lavaSrc.value = lavaZoneSrc[2];
					}else if(doc[1].gpolygons[14].Contains(grabLoc)){
						//zone 5
						lavaZone.value = doc[1].placemarks[14].name;
						lavaDes.value = lavaZoneDes[4];
						lavaMit.value = lavaZoneMit[4];
						lavaSrc.value = lavaZoneSrc[4];
					}else if(doc[1].gpolygons[15].Contains(grabLoc)){
						//zone 6
						lavaZone.value = doc[1].placemarks[15].name;
						lavaDes.value = lavaZoneDes[5];
						lavaMit.value = lavaZoneMit[5];
						lavaSrc.value = lavaZoneSrc[5];
					}else {
						lavaZone.value = ' ';
						lavaDes.value = lavaZoneDes[9];
						lavaMit.value = lavaZoneMit[9];
						lavaSrc.value = lavaZoneSrc[9];
					}
					
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
					
					<!--evacuation zone polygon-->
					/*var zoneCoords1 = [
						//new google.maps.LatLng(doc[0].gpolygons[8].coords)
						
					];	
					
				
					var hawaiiZone1 = new google.maps.Polygon({
						paths: zoneCoords1
					});
		
					hawaiiZone1.setMap(map);*/
					<!--check if point is within the evacuation zone-->
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
			}
			
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
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	
</body>
</html>
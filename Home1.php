<!DOCTYPE html>
<?php 
	session_start();
	require_once('php/functions.php'); 
	if(check_login_status() == false) {

	redirect('Index1.php');
}

?>
<!--Google maps idKey: AIzaSyBDeKh4FF-2J1pT6C82m6XlgdTDmd7AjGk-->
<html>
	<head> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/stylesheet.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&=geometry&sensor=false&key=AIzaSyBDeKh4FF-2J1pT6C82m6XlgdTDmd7AjGk"></script>
		<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		<script type="text/javascript" src="http://geoxml3.googlecode.com/svn/branches/polys/geoxml3.js"></script>
		<script type="text/javascript" src="http://geoxml3.googlecode.com/svn/trunk/ProjectedOverlay.js"></script>
		<script type="text/javascript" src="js/v3_epoly.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/adminFunctions.js"></script>
		<script src="js/Print.js"></script>
	</head>
	<body>
		<?php include('php/dbConnect.php');?>
		
		<!--Menu-->
		<div class="nav navbar-inverse navbar-static-top">
			<div class="container">
			
				<a href="#" class="navbar-brand">Hazard Site</a>
				
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<div class="collapse navbar-collapse navHeaderCollapse">
					<ul class="nav navbar-nav navbar-right">
					
						<li class="active"><a href="Home1.php">Home</a></li>
						<!--<li><a href="#">Blog</a></li>-->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Resources<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="http://www.usgs.gov/">USGS</a></li>
								<li><a href="http://www.noaa.gov/">NOAA</a></li>
								<li><a href="http://www.nps.gov/havo/index.htm">HAVO</a></li>
							</ul>
						</li>
						<!--<li><a href="#">About</a></li>-->
						<li><a href="#contact" data-toggle="modal">Contact</a></li>
						<li><a href="php/logout.php">Logout</a></li>
							
					</ul>
				</div>
			</div>
		</div>
		
		<!--Map with modal-->
		<div class="modal fade" id="viewMap" role="dialog">
			<div class="modal-dialog" style="width: 95%">
				<div class="modal-content">
					<div class="modal-header">
						<h4>Hazard Map</h4>
					</div>	
					<div class="modal-body">
					
						<div class="container">
							<div class="row">
								<div class="col-md-6" style="border:1px solid black">
									<p>Choose a button to add:</p>
									<?php include('php/fetchFiles.php'); ?>
									<div id="viewHazBut"></div>
								</div>
								<div class="col-md-6" style="border:1px solid black">
									<p>type the name of the button to delete:</p>
									<?php include('php/deleteButton.php'); ?>
									<div id="viewHazBut"></div>
								</div>
							</div>
						</div>
						
						</br>
					
						<div class="container">
							<div class="row">
								<div class="col-md-2" style="border:1px solid black">
									<div id="hazButtons">
										<?php include('php/viewButtons.php'); ?>
									</div>
								</div>
								<div class="col-md-7" style="border:1px solid black">
									<div id="mapArea">
										<div class="controls">
											<p>Enter address to view hazard data</p>
											<input id="pac-input" class="controls" type="text" placeholder="Physical Address">
										</div> 
										<div id="map-canvas"></div>
									</div>
								</div>
								<div id="hazArray">
									<div class="col-md-3" style="border:1px solid black">
										<div id="MainMenu">
											<div class="list-group panel">
												<p>View hazard data</p>
												<a href="#Tsunami" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">
													Tsunami zone: <b class="caret" style="float: right"></b><output id="tsunamiZone" type="text" placeholder="WithinEvacZone"></output>
												</a>
												<div class="collapse" id="Tsunami">
													<a href="#TDesc" class="list-group-item" data-toggle="collapse" data-parent="#TDesc">Description: <b class="caret" style="float: right"></b><i class="fa fa-caret-down"></i></a>
													<div class="collapse list-group-submenu" id="TDesc">
														<p><output id="tsuDesc" type="text"></output></p>
														<!--<a href="#" class="list-group-item" data-parent="#TDesc">Description:</a>-->
													</div>
													
													<a href="#TMit" class="list-group-item" data-toggle="collapse" data-parent="#TMit">Mitigation: <b class="caret" style="float: right"></b><i class="fa fa-caret-down"></i></a>
													<div class="collapse list-group-submenu" id="TMit">
														<p><output id="tsuMit" type="text"></output></p>
														<!--<a href="#" class="list-group-item" data-parent="#TMit">Mitigation:</a>-->
													</div>
													
													<a href="#TSrc" class="list-group-item" data-toggle="collapse" data-parent="#TSrc">Sources: <b class="caret" style="float: right"></b><i class="fa fa-caret-down"></i></a>
													<div class="collapse list-group-submenu" id="TSrc">
														<p><output id="tsuSrc" type="text"></output></p>
													</div>
												</div>
												<a href="#Lava" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">
													Lava zone: <b class="caret" style="float: right"></b><output id="lavaZone" type="text" placeholder="WithinEvacZone"></output>
												</a>
												<div class="collapse" id="Lava">
													<a href="#LDesc" class="list-group-item" data-toggle="collapse" data-parent="#LDesc">Description: <b class="caret" style="float: right"></b><i class="fa fa-caret-down"></i></a>
													<div class="collapse list-group-submenu" id="LDesc">
														<p><output id="lavaDesc" type="text"></output></p>
													</div>
													
													<a href="#LMit" class="list-group-item" data-toggle="collapse" data-parent="#LMit">Mitigation: <b class="caret" style="float: right"></b><i class="fa fa-caret-down"></i></a>
													<div class="collapse list-group-submenu" id="LMit">
														<p><output id="lavaMit" type="text"></output></p>
													</div>
													
													<a href="#LSrc" class="list-group-item" data-toggle="collapse" data-parent="#LSrc">Sources: <b class="caret" style="float: right"></b><i class="fa fa-caret-down"></i></a>
													<div class="collapse list-group-submenu" id="LSrc">
														<p><output id="lavaSrc" type="text"></output></p>
													</div>
												</div>
												<a href="#Hurricane" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">
													Hurricane zone: <b class="caret" style="float: right"></b><output id="hurricaneZone" type="text" placeholder="WithinEvacZone"></output>
												</a>
												<div class="collapse" id="Hurricane">
													<a href="#HDesc" class="list-group-item" data-toggle="collapse" data-parent="#HDesc">Description: <b class="caret" style="float: right"></b><i class="fa fa-caret-down"></i></a>
													<div class="collapse list-group-submenu" id="HDesc">
														<p><output id="hurrDesc" type="text"></output></p>
														<!--<a href="#" class="list-group-item" data-parent="#TDesc">Description:</a>-->
													</div>
													
													<a href="#HMit" class="list-group-item" data-toggle="collapse" data-parent="#HMit">Mitigation: <b class="caret" style="float: right"></b><i class="fa fa-caret-down"></i></a>
													<div class="collapse list-group-submenu" id="HMit">
														<p><output id="hurrMit" type="text"></output></p>
														<!--<a href="#" class="list-group-item" data-parent="#TMit">Mitigation:</a>-->
													</div>
													
													<a href="#HSrc" class="list-group-item" data-toggle="collapse" data-parent="#HSrc">Sources: <b class="caret" style="float: right"></b><i class="fa fa-caret-down"></i></a>
													<div class="collapse list-group-submenu" id="HSrc">
														<p><output id="hurrSrc" type="text"></output></p>
													</div>
													
												</div>
											</div>
										</div>	
									</div>
								</div>
							</div>
						</div>
						<a class="btn btn-default" id="Print" type="button" style="float: right" onclick="PrintDiv();" value="Print a report" /><span class="glyphicon glyphicon-print"></span> Print</a>
										
					</div>
					<div class="modal-footer">
						<a class="btn btn-default" data-dismiss="modal">Close</a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="jumbotron">
				<center>
					<h1>Welcome <?php echo $_SESSION['username']; ?></h1>
					<p>You may change some content from the list below.</p>
				</center>
			</div>
		</div>
		
		<div class="container">
			<center>
				<div class="row">
					<div class="col-md-1">
						<a href="#viewMap" data-toggle="modal" class="btn btn-default" onclick="initialize();">View Map</a>
					</div>
					<div class="col-md-1">
						<a href="#addHaz" data-toggle="modal" class="btn btn-default">Add hazard</a>
					</div>
					<div class="col-md-1">
						<a href="#modHaz" data-toggle="modal" class="btn btn-default">Modify data</a>
					</div>
					<div class="col-md-1">
						<a href="#fileUpload" data-toggle="modal" class="btn btn-default">Upload file</a>
					</div>
					
				</div>
			</center>
		</div>
		
		<!--<div class="container">
			<div class="row">
			
				<div class="col-md-3">
					<h3><a href="#">Hazard Levels</a></h3>
					<p>Displays kml files within google maps api</p>
					<h3><a href="#" class="btn btn-default">Read more</a></h3>
				</div>
			
			</div>
		</div>-->
	
		<input type="hidden" id="hazIdent" name="hazIdent" value="">
		<input type="hidden" id="hazValue" name="hazIdent" value="">
		
		<div class="modal fade" id="fileUpload" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" action="php/upload.php" method="post" enctype="multipart/form-data">
						<div class="modal-header">
							<h4>Upload file</h4>
						</div>
						<div class="modal-body">						
							<p>Select image to upload:</p>
							<input class="form-control" type="file" name="uploadfile" id="uploadfile">
						</div>
						<div class="modal-footer">
							<a class="btn btn-default" data-dismiss="modal">Close</a>
							<button class="btn btn-primary" type="submit">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="modHaz" role="dialog">
			<div class="modal-dialog" style="width: 90%">
				<div class="modal-content">
					<form class="form-horizontal" method="get" action="">
						<div class="modal-header">
							<h4>Modify data</h4>
						</div>
						<div class="modal-body">
							<?php include('php/fetchHazards.php'); ?>
							<div id="updateHazTable"></div>
						</div>
						<div class="modal-footer">
							<a class="btn btn-default" data-dismiss="modal">Close</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="addHaz" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="post" action="php/addHazard.php">
						<div class="modal-header">
							<h4>Add Hazard</h4>
						</div>	
						<div class="modal-body">
							<div class="form-group">
								
								<label for="addHazard" class="col-lg-2 control-label">Add hazard:</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="addHazard" id="addHazard" placeholder="Hazard">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<a class="btn btn-default" data-dismiss="modal">Close</a>
							<button class="btn btn-primary" type="submit">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="contact" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal">
						<div class="modal-header">
							<h4>Contact Hazard Site</h4>
						</div>	
						<div class="modal-body">
							<div class="form-group">
								
								<label for="contact-name" class="col-lg-2 control-label">Name:</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" id="contact-name" placeholder="name">
								</div>
								
								<label for="contact-email" class="col-lg-2 control-label">Email:</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" id="contact-email" placeholder="you@example.com">
								</div>
								
								<label for="contact-message" class="col-lg-2 control-label">Message:</label>
								<div class="col-lg-10">
									<textarea class="form-control" rows="8"></textarea>
								</div>
								
							</div>
						</div>
						<div class="modal-footer">
							<a class="btn btn-default" data-dismiss="modal">Close</a>
							<button class="btn btn-primary" type="submit">Send</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="navbar navbar-default navbar-fixed-bottom">
			<div class="container">
				<p class="navbar-text pull-left">Site built by David and Robert</p>
				<a class="navbar-button btn-danger btn pull-right">Subscribe</a>
			</div>
		</div>
	</body>
	<script src="js/adminBot.js"></script>
</html>
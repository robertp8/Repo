<?php>

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

?>
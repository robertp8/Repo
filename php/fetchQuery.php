<?php
/*Author: Robert Peralta */

/*
This script will query to the database to show hazard
info of a specified hazard with in the database
*/

include('dbConnect.php');

$id = $_POST['Hazard_idHazard'];

$sql1 = mysqli_query($conn, "SELECT idHazardZone, hazName, hazVal, hazDesc, hazMit, hazSrc FROM hazard, hazardzone 
							where hazard.idHazard = hazardzone.Hazard_idHazard and hazard.idHazard = '" . $id . "'");
							
while($row = mysqli_fetch_array($sql1)) {
	
	$zoneID = $row['idHazardZone'];
	$hazname = $row['hazName'];
	$hazval = $row['hazVal'];
	$hazdesc = $row['hazDesc'];
	$hazmit = $row['hazMit'];
	$hazsrc = $row['hazSrc'];
	
}

mysqli_close($conn);

?>
<?php
/*Author: Robert Peralta */

/*
This script will query to the database to show hazard
info of a specified hazard with in the database
*/

include('dbConnect.php');

$hazid = $_POST['Hazard_idHazard'];
$hazVal = $_POST['hazVal'];

$sql1 = mysqli_query($conn, "SELECT hazDesc FROM hazardzone WHERE Hazard_idHazard = '" . $hazid . "' AND hazVal = '" . $hazVal . "'");

while ($row = mysqli_fetch_array($sql1, MYSQL_ASSOC)){

	$hazDesc=$row["hazDesc"]; 
	echo $hazDesc;
	
}
	
mysqli_close($conn);
?>
<?php 
/*Author: Robert Peralta */

/*
This script will query to the database to show specified
hazard value with in the database or server
*/

	$sql = mysqli_query($conn, "SELECT idHazard, hazName, hazval FROM hazard, hazardzone");
	while ($row = mysqli_fetch_array($sql, MYSQL_ASSOC)){
		
		$id=$row["idHazard"];
		$hazval=$row["hazVal"];
		$name=$row["hazName"]; 
	}
?>
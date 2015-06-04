<?php 

	$sql = mysqli_query($conn, "SELECT idHazard, hazName, hazval FROM hazard, hazardzone");
	while ($row = mysqli_fetch_array($sql, MYSQL_ASSOC)){
		
		$id=$row["idHazard"];
		$hazval=$row["hazVal"];
		$name=$row["hazName"]; 
	}
?>
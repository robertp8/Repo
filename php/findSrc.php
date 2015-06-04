<?php
include('dbConnect.php');

$hazid = $_POST['Hazard_idHazard'];
$hazVal = $_POST['hazVal'];

$sql1 = mysqli_query($conn, "SELECT hazSrc FROM hazardzone WHERE Hazard_idHazard = '" . $hazid . "' AND hazVal = '" . $hazVal . "'");

while ($row = mysqli_fetch_array($sql1, MYSQL_ASSOC)){

	$hazSrc=$row["hazSrc"]; 
	echo $hazSrc;
	
}
	
mysqli_close($conn);
?>
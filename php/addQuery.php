<?php
/*Author: Robert Peralta*/

/*
This script will query to the database to add hazard info
for a specified hazard
*/

session_start();
include('dbConnect.php');

$sql = mysqli_query($conn, "SELECT * FROM admin WHERE Uname ='" . $_SESSION['username'] . "'");

while($row = mysqli_fetch_array($sql)){
	$id = $row['idAdmin'];
}

$hazval = $_POST['hazVal'];
$hazdesc = $_POST['hazDesc'];
$hazmit = $_POST['hazMit'];
$hazsrc = $_POST['hazSrc'];
$hazid = $_POST['Hazard_idHazard'];

$sql = mysqli_query($conn, "Insert into hazardzone(hazVal, hazDesc, hazMit, hazSrc, Hazard_idHazard, Admin_idAdmin) 
				Values('$hazval', '$hazdesc', '$hazmit', '$hazsrc', '" . $hazid . "', '" . $id . "')");

mysqli_close($conn);
?>
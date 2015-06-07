<?php
/*Author: Robert Peralta*/

/*
This script will query to the database to add hazard info
for a specified hazard
*/

include('dbConnect.php');

$id = $_POST['idHazardZone'];

$sql2 = mysqli_query($conn, "delete from hazardzone Where hazardzone.idHazardZone = '" . $id . "'");

mysqli_close($conn);
?>
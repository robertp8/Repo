<?php
include('dbConnect.php');

$id = $_POST['idHazardZone'];
$hazdesc = $_POST['hazDesc'];
$hazmit = $_POST['hazMit'];	
$hazsrc = $_POST['hazSrc'];
$hazval = $_POST['hazVal'];

$sql2 = mysqli_query($conn, "update hazardzone set hazVal = '" . $hazval . "', hazDesc = '" . $hazdesc . "', hazMit = '" . $hazmit . "', hazSrc = '" . $hazsrc . "' where hazardzone.idHazardZone = '" . $id . "'");

mysqli_close($conn);
?>
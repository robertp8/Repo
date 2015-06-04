<?php
session_start();
include('dbConnect.php');

$sql = mysqli_query($conn, "SELECT * FROM admin WHERE Uname ='" . $_SESSION['username'] . "'");

while($row = mysqli_fetch_array($sql)){
	$id = $row['idAdmin'];
}

$hazard = $_POST['addHazard'];

$sql2 = mysqli_query($conn, "Insert into `hazard`(`hazName`, `Admin_idAdmin`) Values('$hazard', '$id')");

header('Location: ../Home1.php');

mysqli_close($conn);
?>
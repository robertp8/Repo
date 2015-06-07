<?php
/*Author: Robert Peralta */

/*
This script will query will connect us to the database
*/

$servername = "localhost";
$database = "hazards";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
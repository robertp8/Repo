<?php 
/*Author: Robert Peralta */

/*
This script will allow the user to login from the 
login form and mark login status as true.
*/

	require_once('config.php');
	require_once('functions.php');

	session_start();

	if(isset($_SESSION['logged_in'])) {
		
		echo "You are logged in";
		redirect('../Home1.php');

	} else {

		if((!isset($_POST['username'])) || (!isset($_POST['password'])) OR (!ctype_alnum($_POST['username'])) ) {
		
			echo "You need to log in";
			redirect('../Index1.php');
		} 

		$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		
		if(mysqli_connect_errno()) {
			
			printf("Unable to connect to database: %s", mysqli_connect_error());
			exit();
		} else {
			printf("You have connected to the database");
		}

		$username = $mysqli->real_escape_string($_POST['username']);
		$password = $mysqli->real_escape_string($_POST['password']);
		
		$sql = "SELECT * FROM admin WHERE Uname = '" . $username . "' AND Password = '" . $password . "'";
		
		$result = $mysqli->query($sql);
		
		if(is_object($result) && $result->num_rows == 1) {
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['logged_in'] = true;
			redirect('../Home1.php');
			
		} else {
			echo "There is no records of this account";
			redirect('../Index1.php');
		}
	}
?> 
<?php 

	require_once('config.php');
	require_once('functions.php');

	session_start();

	if(isset($_SESSION['logged_in'])) {
		
		echo "You are logged in";
		redirect('../Home.php');

	} else {

		if((!isset($_POST['username'])) || (!isset($_POST['password'])) OR (!ctype_alnum($_POST['username'])) ) {
		
			echo "You need to log in";
			redirect('../Index.php');
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
			redirect('../Home.php');
			
		} else {
			
			echo "There is no records of this account";
			redirect('../Index.php');
		}
		
		
		
	}
?> 